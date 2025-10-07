<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Models\FeedingRecord;

class FeedingRecordController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // default 10
        $feedingRecords = FeedingRecord::with('animal')->orderBy('created_at', 'desc')->paginate($perPage);
        return $this->paginatedResponse($feedingRecords, 'Feeding Records list retrieved successfully');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'feed_date' => 'required|date',
            'feed_type' => 'required|string|max:255',
            'volume' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $feedingRecords = FeedingRecord::create($validated);
        return $this->successResponse($feedingRecords, 'Feeding Records created successfully', 201);
    }

    public function show(string $id)
    {
        $feedingRecords = FeedingRecord::with('animal')->findOrFail($id);
        return $this->successResponse($feedingRecords, 'Feeding Records retrieved successfully');
    }

    public function update(Request $request, string $id)
    {
        $feedingRecords = FeedingRecord::findOrFail($id);

        $validated = $request->validate([
            'animal_id' => 'sometimes|required|exists:animals,id',
            'feed_date' => 'sometimes|required|date',
            'feed_type' => 'sometimes|required|string|max:255',
            'volume' => 'sometimes|required|numeric|min:0',
            'notes' => 'sometimes|nullable|string',
        ]);

        $feedingRecords->update($validated);
        return $this->successResponse($feedingRecords, 'Feeding Records updated successfully');
    }

    public function destroy(string $id)
    {
        $feedingRecords = FeedingRecord::findOrFail($id);
        $feedingRecords->delete();
        return $this->successResponse(null, 'Feeding Records deleted successfully', 204);
    }
}
