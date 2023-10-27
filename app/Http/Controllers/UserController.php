<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'verified'])->except(['EditPassword', 'UpdatePassword']);
    }

    public function index()
    {
        $users = User::select('id', 'name', 'email', 'phone', 'created_at')->get();
        return view('users.index', compact('users'));
    }

    public function new()
    {
        return view('users.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => ['required', 'min:0'],
            'address' => ['required', 'max:255'],
            'password' => 'required|min:6|confirmed|max:255',
        ]);

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $text = "User " . $request->name . " created, datetime: " . now();
        Log::create(['text' => $text]);

        $user->save();
        return redirect('/users')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'min:0'],
            'address' => ['required', 'max:255'],
        ]);

        $user->update($request->all());

        $text = "User " . $user->name . " updated, datetime: " . now();

        Log::create(['text' => $text]);

        return redirect('/users')->with('warning', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $text = "User " . $user->name . " was deleted, datetime: " . now();

        $user->delete();

        Log::create(['text' => $text]);

        return redirect('/users')->with('danger', "User deleted successfully");
    }
}
