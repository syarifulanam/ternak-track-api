<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // default 10
        $animals = Animal::with(['cage', 'sire', 'dam'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return $this->paginatedResponse($animals, 'Animal list retrieved successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|unique:animals,qr_code',
            'species' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'required|in:male,female',
            'status' => 'nullable|string|max:100',
            'sire_id' => 'nullable|exists:animals,id',
            'dam_id' => 'nullable|exists:animals,id',
            'cage_id' => 'nullable|exists:cages,id',
        ]);

        $animal = Animal::create($request->all());
        return response()->json($animal, 201);
    }

    public function show(string $id)
    {
        $animal = Animal::with(['cage', 'sire', 'dam'])->findOrFail($id);
        return response()->json($animal);
    }

    public function update(Request $request, string $id)
    {
        $animal = Animal::findOrFail($id);

        $request->validate([
            'qr_code' => 'sometimes|unique:animals,qr_code,' . $animal->id,
            'species' => 'sometimes|string|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'sometimes|in:male,female',
            'status' => 'nullable|string|max:100',
            'sire_id' => 'nullable|exists:animals,id',
            'dam_id' => 'nullable|exists:animals,id',
            'cage_id' => 'nullable|exists:cages,id',
        ]);

        $animal->update($request->all());
        return response()->json($animal);
    }

    public function destroy(string $id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();

        return response()->json(['message' => 'Animal deleted successfully']);
    }
}
