<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class AssignmentController extends Controller
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
        $assignments = Assignment::all();
        return view('assignment.index',compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $roles = Role::all();
        $users = User::all();
        return view('assignment.create', compact('roles','users'));
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
            'user_id' => 'required|integer|unique:assignments,user_id',
            'role_id' => 'required|integer',
        ]);

        $assignment = Assignment::create([
            'user_id' => $request->user_id,
            'role_id' => $request->role_id, 
        ]);
        return redirect('/assignment/'.$assignment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        return view('assignment.show', compact('assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        $roles = Role::all();
        $users = User::all();

        return view('assignment.edit', compact('assignment','roles','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        $request->validate([
            'user_id' => 'required|integer|unique:assignments,user_id,'.$assignment->id,
            'role_id' => 'required|integer',
        ]);

        $assignment->user_id = $request->user_id;
        $assignment->role_id = $request->role_id;
        $assignment->save();

        $request->session()->flash('message','Successfully modified the assignment!');
        return redirect('assignment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Assignment $assignment)
    {
        $assignment->delete();
        $request->session()->flash('message', 'Successfully deleted the assignment!');
        return redirect('assignment');
    }
}
