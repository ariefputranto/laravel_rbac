<?php

namespace App\Http\Controllers;

use Route;
use App\Permission;
use App\PermissionDetail;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
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

    public function index()
    {
        $permissions = Permission::all();
        return view('permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routes = $this->getRoutes();
        return view('permission.create', compact('routes'));
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
            'name' => 'required|min:3|unique:permissions,name',
            'slug' => 'required|array|min:1',
            'description' => 'string|nullable',
        ]);
        
        DB::beginTransaction();
        try{
            $permission = Permission::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            foreach ($request->slug as $slug) {
                $permission_detail = PermissionDetail::create([
                    'permission_id' => $permission->id,
                    'slug' => $slug,
                ]);
            }

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }

        return redirect('/permission/'.$permission->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(permission $permission)
    {
        return view('permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(permission $permission)
    {
        $routes = $this->getRoutes();
        $permission_route = [];
        foreach ($permission->PermissionDetail as $route) {
            $permission_route []= $route->slug;
        }
        return view('permission.edit', compact('permission','routes','permission_route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, permission $permission)
    {
        $request->validate([
            'name' => 'required|min:3|unique:permissions,name,'.$permission->id,
            'slug' => 'required|array|min:1',
            'description' => 'string|nullable',
        ]);

        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->save();

        $permission_detail = PermissionDetail::where('permission_id', $permission->id)->delete();
        foreach ($request->slug as $slug) {
            $permission_detail = PermissionDetail::create([
                'permission_id' => $permission->id,
                'slug' => $slug,
            ]);
        }

        $request->session()->flash('message','Successfully modified the permission!');
        return redirect('permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,permission $permission)
    {
        $permission_detail = PermissionDetail::where('permission_id', $permission->id)->delete();
        $permission->delete();
        $request->session()->flash('message', 'Successfully deleted the permission!');
        return redirect('permission');
    }
}
