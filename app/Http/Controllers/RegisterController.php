<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.register.register', [
            'categories' => Category::all(), 
            'user' => User::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255', 
            'username'=> 'required|unique:users',
            'email' => 'required|email:dns|unique:users',
            'store_name' => 'nullable|max:255', 
            'categories_id' => 'nullable|integer',
        ]);
        $validatedData['store_status'] = $request->store_status;
        $validatedData['password'] = bcrypt($request->password);

        User::create($validatedData);

        return redirect()->route('register-success');
    }
     
    public function success()
    {
        return view('pages.register.success');
    }

    public function check(Request $request) 
    {
        return User::where('email', $request->email)->count() > 0 ? 'unavailable' : 'Available';
    }
}
