<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeCreateRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $user = User::with('role')
                ->orWhere('name', 'LIKE', '%'.$keyword.'%')
                ->orWhere('email', 'LIKE', '%'.$keyword.'%')
                ->orWhere('phone', 'LIKE', '%'.$keyword.'%')
                ->orWhereHas('role', function($query) use($keyword){
                    $query->where('name', 'LIKE', '%'.$keyword.'%');
                })
                ->orderByRaw('id DESC')->paginate(10);
        return view('user', ['user' => $user]);
    }

    public function create()
    {
        $role = Role::get(['id', 'name']);
        return view('employee-add', ['role' => $role]);
    }

    public function store(EmployeeCreateRequest $request)
    {
        $user = User::create($request->all());

        if ($user) {
            Session::flash('status', 'success');
            Session::flash('message', 'Add New Employee Success');
        }

        return redirect('/employee');
    }

    public function edit($id)
    {
        $user = User::with('role')->findOrFail($id);
        $role = Role::where('id', '!=', $user->role_id)->get(['id', 'name']);
        // dd($user);
        // dd($role);
        return view('employee-edit', ['user' => $user, 'role' => $role]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update($request->all());

        if ($user) {
            Session::flash('status', 'success');
            Session::flash('message', 'Update Employee Success');
        }

        return redirect('/employee');
    }

    public function delete($id)
    {
        $user = User::with('role')->findOrFail($id);
        return view('employee-delete', ['user' => $user]);
    }

    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        if ($user) {
            Session::flash('status', 'success');
            Session::flash('message', 'Delete Employee Success');
        }

        return redirect('/employee');
    }
}
