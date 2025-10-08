<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OffSpring;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class OffspringController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $offsprings = Offspring::with('animal')->orderBy('created_at', 'desc')->paginate($perPage);

        return $this->paginatedResponse($offsprings, 'OffSpring list retrieved successfully');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => 'required|exists:animals,id',
            'child_id' => 'required|exists:animals,id',
            'birth_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $offsprings = Offspring::create($validated);
        return $this->successResponse($offsprings, 'OffSpring created successfully', 201);
    }

    public function show(string $id)
    {
        $offsprings = Offspring::with('animal')->findOrFail($id);
        return $this->successResponse($offsprings, 'OffSpring retrieved successfully');
    }

    public function update(Request $request, string $id)
    {
        $offsprings = Offspring::findOrFail($id);

        $validated = $request->validate([
            'parent_id' => 'sometimes|required|exists:animals,id',
            'child_id' => 'sometimes|required|exists:animals,id',
            'birth_date' => 'sometimes|required|date',
            'notes' => 'sometimes|nullable|string',
        ]);

        $offsprings->update($validated);
        return $this->successResponse($offsprings, 'OffSpring updated successfully');
    }

    public function destroy(string $id)
    {
        $offsprings = Offspring::findOrFail($id);
        $offsprings->delete();
        return $this->successResponse(null, 'OffSpring deleted successfully', 204);
    }
}
