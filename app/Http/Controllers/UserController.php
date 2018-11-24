<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'asc')->paginate(10);

		return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $inputs = $request->all();

		$rules = [
			'name' => 'required', 
			'email' => 'required',
			'password' => 'required',
			'role' => 'required',
		];

		$validation = \Validator::make($inputs,$rules);

		if($validation->fails()) 
			return redirect()->back()->withErrors($validation->errors())->withInput();

		$user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = $request->input("password");
        // $user->role = $request->input("role");

        $role = Role::find($request->input("role"))['name'];
        //Roleが存在するか
        if(!empty($role))
            $user->syncRoles($role);

		$user->save();

		return redirect()->route('users.index')->with('message', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
