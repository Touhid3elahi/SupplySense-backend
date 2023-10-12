<?php

namespace App\Http\Controllers\API;

use App\Models\Rate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rates = Rate::join('suppliers', 'rates.supplier_id', '=', 'suppliers.id')
            ->join('materials', 'rates.material_id', '=', 'materials.id')
            ->select('rates.*', 'suppliers.name as supplier_name', 'materials.name as material_name')
            ->get();

        return response()->json(['rates' => $rates], 200);
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
            'supplier_id' => 'required|exists:suppliers,id',
            'material_id' => 'required|exists:materials,id',
            'rate' => 'required|numeric',
        ]);

        $rate = Rate::create([
            'supplier_id' => $request->supplier_id,
            'material_id' => $request->material_id,
            'rate' => $request->rate,
        ]);

        return response()->json(['rate' => $rate], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rate = Rate::findOrFail($id);
        return response()->json(['rate' => $rate], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rate $rate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rate' => 'required|numeric',
        ]);

        $rate = Rate::findOrFail($id);
        $rate->rate = $request->rate;
        $rate->save();

        return response()->json(['rate' => $rate], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rate = Rate::findOrFail($id);
        $rate->delete();

        return response()->json(['message' => 'Rate deleted'], 200);
    }
}
