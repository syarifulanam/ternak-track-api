<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use App\Models\Animal;
use Illuminate\Http\Request;

class HealthRecordController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search_animal = $request->get('search_animal');
        $search_date = $request->get('search_date');

        $query = HealthRecord::with('animal')->latest();

        if ($search_animal) {
            $query->whereHas('animal', function ($q) use ($search_animal) {
                $q->where('code_animal', 'LIKE', '%' . $search_animal . '%');
            });
        }

        if ($search_date) {
            $query->where('check_date', 'LIKE', '%' . $search_date . '%');
        }

        $health_record = $query->paginate($perPage);
        $health_record->appends($request->query());

        $animals = Animal::select('id', 'code_animal', 'species')->orderBy('code_animal')->get();

        return view('health_record.index', compact('health_record', 'animals', 'search_animal', 'search_date'));
    }

    public function show($id)
    {
        $health_record = HealthRecord::with('animal')->findOrFail($id);
        return response()->json(['status' => 'success', 'health_record' => $health_record]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'animal_id'     => 'required|exists:animals,id',
            'check_date'    => 'required|date',
            'diagnosis'     => 'required|string|max:500',
            'treatment'     => 'nullable|string|max:500',
            'veterinarian'  => 'required|string|max:255',
            'notes'         => 'nullable|string|max:500',
        ]);

        $health_record = HealthRecord::create($data);

        return response()->json(['status' => 'success', 'healt_record' => $health_record]);
    }

    public function update(Request $request, $id)
    {
        $health_record = HealthRecord::findOrFail($id);

        $data = $request->validate([
            'animal_id'     => 'required|exists:animals,id',
            'check_date'    => 'required|date',
            'diagnosis'     => 'required|string|max:500',
            'treatment'     => 'nullable|string|max:500',
            'veterinarian'  => 'required|string|max:255',
            'notes'         => 'nullable|string|max:500',
        ]);

        $health_record->update($data);

        return response()->json(['status' => 'success', 'healt_record' => $health_record]);
    }

    public function destroy($id)
    {
        HealthRecord::findOrFail($id)->delete();
        return response()->json(['status' => 'success']);
    }
}
