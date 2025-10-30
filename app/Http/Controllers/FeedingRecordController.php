<?php

namespace App\Http\Controllers;

use App\Models\FeedingRecord;
use App\Models\Animal;
use Illuminate\Http\Request;

class FeedingRecordController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search_animal = $request->get('search_animal');
        $search_date = $request->get('search_date');

        $query = FeedingRecord::with('animal')->latest();

        if ($search_animal) {
            $query->whereHas('animal', function ($q) use ($search_animal) {
                $q->where('code_animal', 'LIKE', '%' . $search_animal . '%');
            });
        }

        if ($search_date) {
            $query->where('feed_date', 'LIKE', '%' . $search_date . '%');
        }

        $feedingRecords = $query->paginate($perPage);
        $feedingRecords->appends($request->query());

        $animals = Animal::select('id', 'code_animal', 'species')->orderBy('code_animal')->get();

        return view('feeding_record.index', compact('feedingRecords', 'animals', 'search_animal', 'search_date'));
    }

    public function show($id)
    {
        $feedingRecord = FeedingRecord::with('animal')->findOrFail($id);
        return response()->json(['status' => 'success', 'feedingRecord' => $feedingRecord]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'feed_date' => 'required|date',
            'feed_type' => 'required|string|max:255',
            'volume'    => 'required|string|max:255',
            'notes'     => 'nullable|string',
        ]);

        $feedingRecord = FeedingRecord::create($data);

        return response()->json(['status' => 'success', 'feedingRecord' => $feedingRecord]);
    }

    public function update(Request $request, $id)
    {
        $feedingRecord = FeedingRecord::findOrFail($id);

        $data = $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'feed_date' => 'required|date',
            'feed_type' => 'required|string|max:255',
            'volume'    => 'required|string|max:255',
            'notes'     => 'nullable|string',
        ]);

        $feedingRecord->update($data);

        return response()->json(['status' => 'success', 'feedingRecord' => $feedingRecord]);
    }

    public function destroy($id)
    {
        FeedingRecord::findOrFail($id)->delete();
        return response()->json(['status' => 'success']);
    }
}