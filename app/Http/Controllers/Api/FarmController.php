<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return response()->json(Farm::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'owner'   => 'required|string|max:255',
        ]);

        $farm = Farm::create($request->all());

        return response()->json([
            'message' => 'Farm created successfully',
            'data' => $farm
        ], 201);
    }

    public function show(string $id)
    {
        $farm = Farm::findOrFail($id);
        return response()->json($farm);
    }

    public function update(Request $request, string $id)
    {
        $farm = Farm::findOrFail($id);

        $request->validate([
            'name'    => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'owner'   => 'sometimes|required|string|max:255',
        ]);

        $farm->update($request->all());

        return response()->json([
            'message' => 'Farm updated successfully',
            'data' => $farm
        ]);
    }

    public function destroy(string $id)
    {
        $farm = Farm::findOrFail($id);
        $farm->delete();

        return response()->json([
            'message' => 'Farm deleted successfully'
        ]);
    }
}
