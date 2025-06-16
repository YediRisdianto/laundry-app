<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index() 
    {
        return view('master.customer');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email:rfc,dns|max:255',
            'phone_number' => ['required', 'regex:/^\+?[0-9]{9,15}$/'],
            'address' => 'required|string|max:255',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ]);

        return redirect()->route('master.customer')->with('success', 'Customer Created Successfully');
    }
}
