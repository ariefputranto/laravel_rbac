<?php

namespace App\Http\Controllers;

use App\Menu;
use Route;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission');
    }
    
    public function index()
    {
        $menus = Menu::all();
        return view('menu.index',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function getRoutes()
    {
        foreach (Route::getRoutes() as $route) {
            $routes []= $route->uri;
        }

        $routes = array_unique($routes);
        $exclude = ['api/user','/','login','logout','register','password/reset','password/reset/{token}','password/email','home'];

        foreach ($routes as $key => $val) {
            if (in_array($val, $exclude)) {
                unset($routes[$key]);
            }
        }

        return $routes;
    }

    public function create()
    {
        $routes = $this->getRoutes();
        $menu_parent = Menu::where('parent',null)->get();
        return view('menu.create', compact('menu_parent','routes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'slug' => 'string|nullable',
            'parent' => 'integer|nullable',
        ]);
        
        $menu = Menu::create([
            'name' => $request->name,
            'slug' => $request->slug, 
            'parent' => $request->parent,
        ]);
        return redirect('/menu/'.$menu->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return view('menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $routes = $this->getRoutes();
        $menu_parent = Menu::whereNull('parent')->where('id','!=',$menu->id)->get();
        return view('menu.edit', compact('menu_parent','menu','routes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|min:3',
            'slug' => 'string|nullable',
            'parent' => 'integer|nullable'
        ]);

        $menu->name = $request->name;
        $menu->slug = $request->slug;
        $menu->parent = $request->parent;
        $menu->save();

        $request->session()->flash('message','Successfully modified the menu!');
        return redirect('menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Menu $menu)
    {
        $menu->delete();
        $request->session()->flash('message', 'Successfully deleted the menu!');
        return redirect('menu');
    }
}
