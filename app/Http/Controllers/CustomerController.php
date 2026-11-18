<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required", "string"],
            "password" => ["required", "string", "min:8"],
            "email" => ["required", "string", "email", "unique:customers,email"],
            "phone_number" => ["required", "string", "unique:customers,phone_number"],
        ]);

        $customer = Customer::create($request->all());

        return response()->json([
            "status" => "success",
            "customer" => $customer
        ]);
    }
}
