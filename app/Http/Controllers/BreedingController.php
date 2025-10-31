<?php

namespace App\Http\Controllers;

use App\Models\Breeding;
use App\Models\Animal;
use Illuminate\Http\Request;

class BreedingController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search_dam = $request->get('search_dam');
        $search_sire = $request->get('search_sire');
        $search_status = $request->get('search_status');

        $query = Breeding::with(['dam', 'sire'])->latest();

        if ($search_dam) {
            $query->whereHas('dam', function ($q) use ($search_dam) {
                $q->where('code_animal', 'LIKE', '%' . $search_dam . '%');
            });
        }

        if ($search_sire) {
            $query->whereHas('sire', function ($q) use ($search_sire) {
                $q->where('code_animal', 'LIKE', '%' . $search_sire . '%');
            });
        }

        if ($search_status) {
            $query->where('status', 'LIKE', '%' . $search_status . '%');
        }

        $breedings = $query->paginate($perPage);
        $breedings->appends($request->query());

        $animals = Animal::select('id', 'code_animal', 'species')
            ->orderBy('code_animal')
            ->get();

        return view('breeding.index', compact('breedings', 'animals', 'search_dam', 'search_sire', 'search_status'));
    }

    public function show($id)
    {
        $breeding = Breeding::with(['dam', 'sire'])->findOrFail($id);
        return response()->json(['status' => 'success', 'breeding' => $breeding]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'dam_id' => 'required|exists:animals,id|different:sire_id',
            'sire_id' => 'required|exists:animals,id|different:dam_id',
            'mating_date' => 'required|date',
            'status' => 'required|string|max:255',
            'expected_birth_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $breeding = Breeding::create($data);

        return response()->json(['status' => 'success', 'breeding' => $breeding]);
    }

    public function update(Request $request, $id)
    {
        $breeding = Breeding::findOrFail($id);

        $data = $request->validate([
            'dam_id' => 'required|exists:animals,id',
            'sire_id' => 'required|exists:animals,id',
            'mating_date' => 'required|date',
            'status' => 'required|string|max:255',
            'expected_birth_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $breeding->update($data);

        return response()->json(['status' => 'success', 'breeding' => $breeding]);
    }

    public function destroy($id)
    {
        Breeding::findOrFail($id)->delete();
        return response()->json(['status' => 'success']);
    }
}
