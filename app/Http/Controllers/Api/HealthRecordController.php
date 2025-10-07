<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HealthRecord;

class HealthRecordController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $healthRecord = HealthRecord::with('animal')->orderBy('created_at', 'desc')->paginate($perPage);
        return $this->paginatedResponse($healthRecord, 'Health Record list retrieved successfully');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'animal_id'    => 'required|exists:animals,id',
            'check_date'   => 'required|date',
            'diagnosis'    => 'required|string',
            'treatment'    => 'nullable|string',
            'veterinarian' => 'required|string',
            'notes'        => 'nullable|string',
        ]);

        $healthRecord = HealthRecord::create($validated);

        return $this->successResponse($healthRecord, 'Health Record created successfully', 201);
    }

    public function show(string $id)
    {
        $healthRecord = HealthRecord::with('animal')->findOrFail($id);
        return $this->successResponse($healthRecord, 'Health Record  retrieved successfully');
    }

    public function update(Request $request, string $id)
    {
        $healthRecord = HealthRecord::findOrFail($id);

        $validated = $request->validate([
            'animal_id'    => 'sometimes|required|exists:animals,id',
            'check_date'   => 'sometimes|required|date',
            'diagnosis'    => 'sometimes|required|string',
            'treatment'    => 'sometimes|nullable|string',
            'veterinarian' => 'sometimes|required|string',
            'notes'        => 'sometimes|nullable|string',
        ]);


        $healthRecord->update($validated);
        return $this->successResponse($healthRecord, 'Health Record successfully');
    }

    public function destroy(string $id)
    {
        $healthRecord = HealthRecord::findOrFail($id);
        $healthRecord->delete();
        return $this->successResponse(null, 'Ticket deleted successfully', 204);
    }
}
