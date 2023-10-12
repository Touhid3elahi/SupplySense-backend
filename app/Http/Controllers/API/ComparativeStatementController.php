<?php

namespace App\Http\Controllers\API;

use App\Models\Rate;
use App\Models\Material;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\ComparativeStatement;

class ComparativeStatementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comparativeStatements = ComparativeStatement::all();
        return response()->json($comparativeStatements);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $comparativeStatement = ComparativeStatement::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['message' => 'Comparative statement created successfully'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(ComparativeStatement $comparativeStatement)
    {
        return response()->json($comparativeStatement);
    }


    public function compare(Request $request)
    {
        // Validate the request, ensuring you have selected materials and suppliers
        $request->validate([
            'selected_materials' => 'required|array',
            'selected_suppliers' => 'required|array',
        ]);

        // Get the selected materials and suppliers from the request
        $selectedMaterials = $request->input('selected_materials');
        $selectedSuppliers = $request->input('selected_suppliers');

        // Initialize an array to store comparison results
        $comparisonResults = [];

        // Loop through selected materials
        foreach ($selectedMaterials as $materialId) {
            $material = Material::find($materialId);
            $lowestRate = null; // Initialize the lowest rate variable

            // Loop through selected suppliers
            foreach ($selectedSuppliers as $supplierId) {
                $rate = Rate::where('material_id', $materialId)
                    ->where('supplier_id', $supplierId)
                    ->first();

                if (!$lowestRate || ($rate && $rate->rate < $lowestRate->rate)) {
                    $lowestRate = $rate; // Update the lowest rate if a lower rate is found
                }
            }

            // Store the lowest rate and material information
            $comparisonResults[] = [
                'material' => $material,
                'lowest_rate' => $lowestRate,
            ];
        }

        return response()->json($comparisonResults);
    }


}
