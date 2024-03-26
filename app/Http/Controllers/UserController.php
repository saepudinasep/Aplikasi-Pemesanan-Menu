<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeCreateRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $user = User::with('role')
            ->whereNull('deleted_at') // Menampilkan hanya pengguna yang tidak dihapus secara lembut
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('phone', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('role', function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', '%' . $keyword . '%');
                    });
            })
            ->orderByDesc('id')
            ->paginate(10);

        return view('user', ['user' => $user]);
    }


    public function create()
    {
        $role = Role::get(['id', 'name']);
        return view('employee-add', ['role' => $role]);
    }

    public function store(EmployeeCreateRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (preg_match('/\d/', $value)) {
                        $fail($attribute . 'Nama mengandung karakter yang tidak valid.');
                    }
                },
            ],
            'email' => 'required|email|unique:users,email',
            'phone' => [
                'required',
                'regex:/^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$/',
            ],
            'role_id' => 'required|exists:roles,id',
        ], [
            'email.unique' => 'Alamat email telah digunakan.',
            'phone.regex' => 'Nomor telepon harus nomor telepon Indonesia yang valid.',
        ]);

        if ($validator->fails()) {
            return redirect('/employee-add')
                ->withErrors($validator)
                ->withInput();
        }

        $userData = $request->all();
        $userData['password'] = Hash::make($userData['email']); // Set password sama dengan email

        $user = User::create($userData);

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

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Delete Employee Success'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete user'
            ]);
        }
    }
}
