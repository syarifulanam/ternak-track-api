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
        $cages = Cage::with(['animals', 'farm'])->orderBy('created_at', 'desc')->paginate($perPage);

        return $this->paginatedResponse($cages, 'Cage list retrieved successfully');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'farm_id'  => 'required|exists:farms,id',
            'name'     => 'required|string|max:255',
            'capacity' => 'required|integer',
        ]);

        $cage = Cage::create($validated);

        return $this->successResponse($cage, 'Cage created successfully', 201);
    }

    public function show(string $id)
    {
        $cage = Cage::with('animals', 'farm')->findOrFail($id);
        return $this->successResponse($cage, 'Cage retrieved successfully');
    }

    public function update(Request $request, string $id)
    {
        $cage = Cage::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'sometimes|string|max:255',
            'capacity' => 'sometimes|integer',
        ]);

        $cage->update($validated);
        return $this->successResponse($cage, 'Cage updated successfully');
    }

    public function destroy(string $id)
    {
        $cage = Cage::findOrFail($id);
        $cage->delete();

        return $this->successResponse(null, 'Cage deleted successfully', 204);
    }
}
