<?php

namespace App\Http\Controllers\Api;

use App\Models\Cage;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CageController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $cages = Cage::with('farm')->orderBy('created_at', 'desc')->paginate($perPage);

        return $this->paginatedResponse($cages, 'Cage list retrieved successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
        ]);

        $cage = Cage::create($request->all());
        return response()->json($cage, 201);
    }

    public function show(string $id)
    {
        $cage = Cage::with('farm')->findOrFail($id);
        return response()->json($cage);
    }

    public function update(Request $request, string $id)
    {
        $cage = Cage::findOrFail($id);

        $request->validate([
            'farm_id' => 'exists:farms,id',
            'name' => 'string|max:255',
            'capacity' => 'integer',
        ]);

        $cage->update($request->all());
        return response()->json($cage);
    }

    public function destroy(string $id)
    {
        $cage = Cage::findOrFail($id);
        $cage->delete();

        return response()->json(['message' => 'Cage deleted successfully']);
    }
}
