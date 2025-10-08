<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class SaleController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $sales = Sale::with('animal')->orderBy('created_at', 'desc')->paginate($perPage);

        return $this->paginatedResponse($sales, 'Sales list retrieved successfully');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'sale_date' => 'required|date',
            'buyer' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $sales = Sale::create($validated);
        return $this->successResponse($sales, 'Sales created successfully', 201);
    }

    public function show(string $id)
    {
        $sales = Sale::with('animal')->findOrFail($id);
        return $this->successResponse($sales, 'Sales retrieved successfully');
    }

    public function update(Request $request, string $id)
    {
        $sales = Sale::findOrFail($id);

        $validated = $request->validate([
            'animal_id' => 'sometimes|required|exists:animals,id',
            'sale_date' => 'sometimes|required|date',
            'buyer' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'notes' => 'sometimes|nullable|string',
        ]);


        $sales->update($validated);
        return $this->successResponse($sales, 'Sales updated successfully');
    }

    public function destroy(string $id)
    {
        $sales = Sale::findOrFail($id);
        $sales->delete();
        return $this->successResponse(null, 'Sales deleted successfully', 204);
    }
}
