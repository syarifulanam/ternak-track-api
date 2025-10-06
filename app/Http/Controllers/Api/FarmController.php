<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $farms = Farm::with('cage')->orderBy('created_at', 'desc')->paginate($perPage);

        return $this->paginatedResponse($farms, 'Farm list retrieved successfully');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'owner'   => 'required|string|max:255',
        ]);

        $farm = Farm::create($validated);
        return $this->successResponse($farm, 'Farm created successfully', 201);
    }

    public function show(string $id)
    {
        $farm = Farm::with('cage')->findOrFail($id);
        return $this->successResponse($farm, 'Farm retrieved successfully');
    }

    public function update(Request $request, string $id)
    {
        $farm = Farm::findOrFail($id);

        $validated = $request->validate([
            'name'    => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'owner'   => 'sometimes|required|string|max:255',
        ]);

        $farm->update($validated);

        return $this->successResponse($farm, 'Farm updated successfully');
    }

    public function destroy(string $id)
    {
        $farm = Farm::findOrFail($id);
        $farm->delete();

        return $this->successResponse(null, 'Farm deleted successfully', 204);
    }
}
