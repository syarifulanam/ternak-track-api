<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Breeding;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;


class BreedingController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $breedings = Breeding::with('animal')->orderBy('created_at', 'desc')->paginate($perPage);
        return $this->paginatedResponse($breedings, 'Breedings list retrieved successfully');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'dam_id' => 'required|exists:animals,id',
            // 'sire_id' => 'required|exists:animals,id',
            'mating_date' => 'required|date',
            'status' => 'required|in:success,failed',
            'expected_birth_date' => 'nullable|date|after_or_equal:mating_date',
            'notes' => 'nullable|string',
        ]);

        $breedings = Breeding::create($validated);
        return $this->successResponse($breedings, 'Breedings created successfully', 201);
    }

    public function show(string $id)
    {
        $breedings = Breeding::with('animal')->findOrFail($id);
        return $this->successResponse($breedings, 'Breedings retrieved successfully');
    }

    public function update(Request $request, string $id)
    {
        $breedings = Breeding::findOrFail($id);

        $validated = $request->validate([
            // 'dam_id' => 'sometimes|required|exists:animals,id',
            // 'sire_id' => 'sometimes|required|exists:animals,id',
            'mating_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:success,failed',
            'expected_birth_date' => 'sometimes|nullable|date|after_or_equal:mating_date',
            'notes' => 'sometimes|nullable|string',
        ]);

        $breedings->update($validated);
        return $this->successResponse($breedings, 'Breedings updated successfully');
    }

    public function destroy(string $id)
    {
        $breedings = Breeding::findOrFail($id);
        $breedings->delete();
        return $this->successResponse(null, 'Breedings deleted successfully', 204);
    }
}
