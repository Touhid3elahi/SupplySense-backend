<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Material::all();
        return response()->json($materials);
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
            'description' => 'nullable|string',
            'unit_of_measurement' => 'required|string|max:50',
            // Add more validation rules as needed
        ]);

        $material = new Material([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'unit_of_measurement' => $request->input('unit_of_measurement'),
            // Assign other fields here
        ]);

        $material->save();

        return response()->json(['message' => 'Material created successfully'], Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        return response()->json($material);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit_of_measurement' => 'required|string|max:50',
            // Add more validation rules as needed
        ]);

        $material->name = $request->input('name');
        $material->description = $request->input('description');
        $material->unit_of_measurement = $request->input('unit_of_measurement');
        // Update other fields here

        $material->save();

        return response()->json(['message' => 'Material updated successfully'], Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {

        $material->delete();
        return response()->json(['message' => 'Material deleted successfully'], Response::HTTP_OK);

    }
}
