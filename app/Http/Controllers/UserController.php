<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'verified'])->except(['EditPassword', 'UpdatePassword', 'edit', 'update']);
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function new()
    {
        return view('users.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        if ($request->password == $request->password_confirmation) {
            $user = new User();
            $user->email = $request->email;
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->role = $request->role;
            $user->password = Hash::make($request->password);

            $text = "User " . $request->name . " created, datetime: " . now();
            Log::create(['text' => $text]);

            $user->save();
            return redirect('/users')->with('success', 'User created successfully');
        } else {
            return redirect('/user/new')->with('danger', 'User cannot be created');
        }
    }

    public function edit()
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();

        $text = "User " . $user->name . " updated, datetime: " . now();
        Log::create(['text' => $text]);
        return redirect('/users')->with('warning', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $text = "User " . $user->name . " was deleted, datetime: " . now();
        $user->delete();
        Log::create(['text' => $text]);
        return redirect('/users')->with('danger', "User deleted successfully");
    }

    public function EditPassword()
    {
        $user = Auth::user();
        return view('users.edit_password', compact('user'));
    }

    public function UpdatePassword(Request $request)
    {
        $user = User::findOrFail(Auth()->user()->id);
        if (!Hash::check($request->password, $user->password)) {
            return back()->with("danger", "Old Password Doesn't match!");
        }

        if ($request->new_password == $request->confirm_password) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect('/users')->with('warning', "Your password has been changed");
        } else {
            return redirect()->back()->with('danger', "Passwords do not match!");
        }
    }

}