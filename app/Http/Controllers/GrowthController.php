<?php

namespace App\Http\Controllers;

use App\Models\Growth;
use App\Models\Animal;
use Illuminate\Http\Request;

class GrowthController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search_animal = $request->get('search_animal');
        $search_date = $request->get('search_date');

        $query = Growth::with('animal')->latest();

        if ($search_animal) {
            $query->whereHas('animal', function ($q) use ($search_animal) {
                $q->where('code_animal', 'LIKE', '%' . $search_animal . '%');
            });
        }

        if ($search_date) {
            $query->where('record_date', 'LIKE', '%' . $search_date . '%');
        }

        $growths = $query->paginate($perPage);

        $growths->appends($request->query());
        $animals = Animal::select('id', 'code_animal', 'species')
            ->orderBy('code_animal')
            ->get();

        return view('growths.index', compact('growths', 'animals', 'search_animal', 'search_date'));
    }

    public function show($id)
    {
        $growths = Growth::with('animal')->findOrFail($id);
        return response()->json(['status' => 'success', 'growth' => $growths]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'animal_id'   => 'required|exists:animals,id',
            'record_date' => 'required|date',
            'weight_kg'   => 'required|numeric|min:0',
            'height_cm'   => 'required|numeric|min:0',
            'notes'       => 'nullable|string|max:500',
        ]);

        $growths = Growth::create($data);

        return response()->json(['status' => 'success', 'growth' => $growths]);
    }

    public function update(Request $request, $id)
    {
        $growths = Growth::findOrFail($id);

        $data = $request->validate([
            'animal_id'   => 'required|exists:animals,id',
            'record_date' => 'required|date',
            'weight_kg'   => 'required|numeric|min:0',
            'height_cm'   => 'required|numeric|min:0',
            'notes'       => 'nullable|string|max:500',
        ]);

        $growths->update($data);

        return response()->json(['status' => 'success', 'growth' => $growths]);
    }

    public function destroy($id)
    {
        Growth::findOrFail($id)->delete();
        return response()->json(['status' => 'success']);
    }
}
