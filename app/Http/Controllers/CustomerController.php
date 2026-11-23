<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Display all customers
    public function index()
    {
        $customers = Customer::all();

        return response()->json($customers);
    }

    // Display one customer with their borrowings
    public function show(Customer $customer)
    {
        $customer->load('borrowings');

        return response()->json($customer);
    }

    // Register a new customer
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "string"],
            "password" => ["required", "string", "min:8"],
            "email" => ["required", "string", "email", "unique:customers,email"],
            "phone_number" => ["required", "string", "unique:customers,phone_number"],
        ]);

        $customer = Customer::create($data);

        $token = $customer->createToken("login")->plainTextToken;

        return response()->json([
            "customer" => $customer,
            "token" => $token,
        ], 201);
    }
}
