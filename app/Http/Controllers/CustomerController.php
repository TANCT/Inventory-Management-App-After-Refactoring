<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $customers = Customer::all();
            return response()->json(['customers' => $customers], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve users', 'error' => $e->getMessage()], 500);
        }
    }


  

    /**
     * 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'name' => 'required'
            ]);
    
            // Create a new user
            $customer = Customer::create([
                'name' => $validatedData['name'],
                
            ]);
    
            return response()->json(['message' => 'Customer created successfully', 'customer' => $customer], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create the customer', 'error' => $e->getMessage()], 500);
        }
    }

    

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Customer $customer)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Customer $customer)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Customer $customer)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Customer $customer)
    // {
    //     //
    // }
}
