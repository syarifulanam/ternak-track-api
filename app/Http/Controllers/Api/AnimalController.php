<?php

namespace App\Http\Controllers\Api;

use App\Models\Animal;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnimalController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $animal = Animal::orderBy('created_at', 'desc')->paginate($perPage);

        return $this->paginatedResponse($animal, 'Animal list retrieved successfully');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'qr_code' => 'required|unique:animals,qr_code',
            'species' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'required|in:male,female',
            'status' => 'nullable|string|max:100',
            // 'dam_id' => 'required|exists:animals,id',
            // 'sire_id' => 'required|exists:animals,id',
            'cage_id' => 'nullable|exists:cages,id',
        ]);

        $animal = Animal::create($validated);

        return $this->successResponse($animal, 'Animal created successfully', 201);
    }

    public function show(string $id)
    {
        $animal = Animal::findOrFail($id);
        return $this->successResponse($animal, 'Animal retrieved successfully');
    }

    public function update(Request $request, string $id)
    {
        $animal = Animal::findOrFail($id);

        $validated = $request->validate([
            'qr_code' => 'sometimes|unique:animals,qr_code,' . $animal->id,
            'species' => 'sometimes|string|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'sometimes|in:male,female',
            'status' => 'nullable|string|max:100',
            // 'dam_id' => 'sometimes|required|exists:animals,id',
            // 'sire_id' => 'sometimes|required|exists:animals,id',
            'cage_id' => 'nullable|exists:cages,id',
        ]);

        $animal->update($validated);

        return $this->successResponse($animal, 'Animal updated successfully');
    }

    public function destroy(string $id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();

        return $this->successResponse(null, 'Animal deleted successfully', 204);
    }
}
