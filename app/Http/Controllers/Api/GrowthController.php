<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Growth;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class GrowthController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $growths = Growth::with('animal')->orderBy('created_at', 'desc')->paginate($perPage);
        return $this->paginatedResponse($growths, 'Growth records list retrieved successfully');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'animal_id'   => 'required|exists:animals,id',
            'record_date' => 'required|date',
            'weight_kg'   => 'required|numeric|min:0',
            'height_cm'   => 'required|numeric|min:0',
            'notes'       => 'nullable|string'
        ]);

        $growths = Growth::create($validated);
        return $this->successResponse($growths, 'Growth records created successfully', 201);
    }

    public function show(string $id)
    {
        $growths = Growth::with('animal')->findOrFail($id);
        return $this->successResponse($growths, 'Growth records retrieved successfully');
    }

    public function update(Request $request, string $id)
    {
        $growths = Growth::findOrFail($id);

        $validated = $request->validate([
            'animal_id'   => 'sometimes|exists:animals,id',
            'record_date' => 'sometimes|date',
            'weight_kg'   => 'sometimes|numeric|min:0',
            'height_cm'   => 'sometimes|numeric|min:0',
            'notes'       => 'nullable|string'
        ]);

        $growths->update($validated);
        return $this->successResponse($growths, 'Growth records updated successfully');
    }

    public function destroy(string $id)
    {
        $growths = Growth::findOrFail($id);
        $growths->delete();
        return $this->successResponse(null, 'Growth records deleted successfully', 204);
    }
}
