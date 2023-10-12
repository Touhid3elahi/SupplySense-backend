<?php

namespace App\Http\Controllers\API;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'contact_information' => 'nullable|string|max:255',
            // Add more validation rules as needed
        ]);

        $supplier = new Supplier([
            'name' => $request->input('name'),
            'contact_information' => $request->input('contact_information'),
            // Assign other fields here
        ]);

        $supplier->save();

        return response()->json(['message' => 'Supplier created successfully'], Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_information' => 'nullable|string|max:255',
            // Add more validation rules as needed
        ]);

        $supplier->name = $request->input('name');
        $supplier->contact_information = $request->input('contact_information');
        // Update other fields here

        $supplier->save();

        return response()->json(['message' => 'Supplier updated successfully'], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response()->json(['message' => 'Supplier deleted successfully'], Response::HTTP_OK);

    }
}
