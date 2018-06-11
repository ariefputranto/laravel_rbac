<?php

namespace App\Http\Middleware;

use Closure;
use View;
use App\Permission;
use App\Menu;
use Illuminate\Contracts\Auth\Guard;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function validateRoute($routes, $path)
    {
        $is_valid = false;

        foreach ($routes as $route) {
            $is_edit = strpos($path, 'edit') !== false ? true : false;
            $is_store = strpos($path, 'edit') === false && strpos($route, '{') !== false ? true : false;
            $path_tmp = $path;
            if ($is_edit) {
                $split_path = explode('/', $path_tmp);
                unset($split_path[1]);
                $split_path[2] = '/'.$split_path[2];
                $path_tmp = implode('/', $split_path);
                $route = preg_replace('#\{[^\)]*\}#', '', $route);
            }elseif ($is_store) {
                $index_id = strpos($path_tmp, '/');
                $path_tmp = substr($path_tmp, 0, $index_id+1);
                $route = preg_replace('#\{[^\)]*\}#', '', $route);
            }

            if ($route == $path_tmp)
                $is_valid = true;
        }

        return $is_valid;
    }

    public function handle($request, Closure $next)
    {
        $route = [];
        $menus_parent = [];
        $menus_child = [];
        $check_parent = '';
        $check_child = [];

        $permissions = $this->auth->user()->Assignment->Role->Permission;
        foreach ($permissions as $permission) {
            foreach ($permission->PermissionDetail as $detail) {
                $route []= $detail->slug;

                $menu = Menu::where('slug', $detail->slug)->first();
                if (!is_null($menu)) {
                    if ($check_parent != $menu->parent) {
                        $check_parent = $menu->parent;
                        $menus_parent []= Menu::find($check_parent);
                    }
                    if (!in_array($menu->slug, $check_child)) {
                        $menus_child [$menu->parent][]= $menu;
                        $check_child []= $menu->slug;
                    }
                }
            }
        }

        if ($this->validateRoute($route, $request->path()) || $request->path() == "home") {

            View::share('menus_parent', $menus_parent);
            View::share('menus_child', $menus_child);

            return $next($request);
        }

        return redirect('home');
    }
}
