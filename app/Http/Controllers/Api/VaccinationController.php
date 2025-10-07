<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vaccination;


class VaccinationController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $vaccinations = Vaccination::with('animal')->orderBy('created_at', 'desc')->paginate($perPage);
        return $this->paginatedResponse($vaccinations, 'Vaccinations list retrieved successfully');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'animal_id'         => 'required|exists:animals,id',
            'vaccination_date'  => 'required|date',
            'vaccine_type'      => 'required|string',
            'dosage'            => 'nullable|string',
            'staff'             => 'required|string',
        ]);

        $vaccinations = Vaccination::create($validated);
        return $this->successResponse($vaccinations, 'Vaccinations created successfully', 201);
    }

    public function show(string $id)
    {
        $vaccinations = Vaccination::with('animal')->findOrFail($id);
        return $this->successResponse($vaccinations, 'Vaccinations retrieved successfully');
    }


    public function update(Request $request, string $id)
    {
        $vaccinations = Vaccination::findOrFail($id);

        $validated = $request->validate([
            'animal_id'         => 'sometimes|required|exists:animals,id',
            'vaccination_date'  => 'sometimes|required|date',
            'vaccine_type'      => 'sometimes|required|string',
            'dosage'            => 'sometimes|nullable|string',
            'staff'             => 'sometimes|required|string',
        ]);


        $vaccinations->update($validated);
        return $this->successResponse($vaccinations, 'Vaccinations updated successfully');
    }

    public function destroy(string $id)
    {
        $vaccinations = Vaccination::findOrFail($id);
        $vaccinations->delete();
        return $this->successResponse(null, 'Vaccinations deleted successfully', 204);
    }
}
