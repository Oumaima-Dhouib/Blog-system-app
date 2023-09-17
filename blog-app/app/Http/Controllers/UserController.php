<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request): View
    {
        $data = User::latest()->paginate(10);

        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }


    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'userName' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'image' => 'required|max:1048',

        ]);

        $filename = "";
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $originalFilename = $file->getClientOriginalName();
            $filenameWithoutExtension = pathinfo($originalFilename, PATHINFO_FILENAME);
            $filename = $filenameWithoutExtension . '_' . Str::random(20) . '.' . $extention;
            $file->move('images/', $filename);
            $request->merge(['image' => $filename]);
        }

        
        $hashedPassword = Hash::make($request->password);
        $request->merge(['password' => $hashedPassword]);
        $user = User::create($request->all());
        $user->assignRole($request->input('roles'));
        if ($user->image) {
            $user->image = $filename;
            $user->save();
        }
        

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function show($id): View
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'userName' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
            'image' => 'max:1048',
        ]);

         $filename = "";
         $user = User::find($id);
       
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $originalFilename = $file->getClientOriginalName();
            $filenameWithoutExtension = pathinfo($originalFilename, PATHINFO_FILENAME);
            $filename = $filenameWithoutExtension . '_' . Str::random(20) . '.' . $extention;
            $file->move('images/', $filename);
            $request->merge(['image' => $filename]);
            File::delete(public_path('images/' . $user->image));
            $user->image = $filename;
        } else {
            $filename = $user->image;
        }

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));
        if ($user->image) {
            $user->image = $filename;
            $user->save();
        }

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
