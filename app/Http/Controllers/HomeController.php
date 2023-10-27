<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only('profile', 'save_profile', 'EditPassword', 'UpdatePassword');
    }

    public function index()
    {
        $bundles = Product::where('is_bundle', true)->get();
        return view('index', compact('bundles'));
    }

    public function download_refund_policy()
    {
        $filename = "refund_policy.pdf";
        $publicPath = public_path();

        $filePath = $publicPath . '/assets/pdf/' . $filename;

        if (file_exists($filePath)) {
            $mime = mime_content_type($filePath);
            return response()->download($filePath, $filename, ['Content-Type' => $mime]);
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }

    public function download_shipping_policy()
    {
        $filename = "shipping_policy.pdf";
        $publicPath = public_path();

        $filePath = $publicPath . '/assets/pdf/' . $filename;

        if (file_exists($filePath)) {
            $mime = mime_content_type($filePath);
            return response()->download($filePath, $filename, ['Content-Type' => $mime]);
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }

    public function download_privacy_policy()
    {
        $filename = "privacy_policy.pdf";
        $publicPath = public_path();

        $filePath = $publicPath . '/assets/pdf/' . $filename;

        if (file_exists($filePath)) {
            $mime = mime_content_type($filePath);
            return response()->download($filePath, $filename, ['Content-Type' => $mime]);
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }

    public function download_terms_of_service()
    {
        $filename = "terms_of_service.pdf";
        $publicPath = public_path();

        $filePath = $publicPath . '/assets/pdf/' . $filename;

        if (file_exists($filePath)) {
            $mime = mime_content_type($filePath);
            return response()->download($filePath, $filename, ['Content-Type' => $mime]);
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }

    public function shop()
    {
        $categories = Category::select('id', 'name')->where('active', true)->get();
        $products = Product::where('quantity', '!=', 0)->filter()->get();

        $data = compact('categories', 'products');
        return view('shop', $data);
    }

    public function custom_logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

    public function profile()
    {
        return view('profile');
    }

    public function save_profile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
        ]);

        $user = User::find(auth()->user()->id);

        $user->update(
            $request->all()
        );

        return redirect()->back()->with('success', 'Profile updated successfully...');
    }

    public function EditPassword()
    {
        return view('edit_password');
    }

    public function UpdatePassword(Request $request)
    {
        $user = User::find(auth()->user()->id);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with("danger", "Old Password Doesn't match!");
        }

        if ($request->new_password == $request->confirm_password) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', "Your password has been changed");
        } else {
            return redirect()->back()->with('danger', "Passwords do not match!");
        }
    }
}
