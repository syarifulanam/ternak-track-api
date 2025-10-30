<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use App\Models\Animal;
use Illuminate\Http\Request;

class VaccinationController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search_animal = $request->get('search_animal');
        $search_date = $request->get('search_date');

        $query = Vaccination::with('animal')->latest();

        if ($search_animal) {
            $query->whereHas('animal', function ($q) use ($search_animal) {
                $q->where('code_animal', 'LIKE', '%' . $search_animal . '%');
            });
        }

        if ($search_date) {
            $query->where('vaccination_date', 'LIKE', '%' . $search_date . '%');
        }

        $vaccinations = $query->paginate($perPage);
        $vaccinations->appends($request->query());

        $animals = Animal::select('id', 'code_animal', 'species')->orderBy('code_animal')->get();

        return view('vaccinations.index', compact('vaccinations', 'animals', 'search_animal', 'search_date'));
    }

    public function show($id)
    {
        $vaccination = Vaccination::with('animal')->findOrFail($id);
        return response()->json(['status' => 'success', 'vaccination' => $vaccination]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'animal_id'        => 'required|exists:animals,id',
            'vaccination_date' => 'required|date',
            'vaccine_type'     => 'required|string|max:255',
            'dosage'           => 'required|string|max:255',
            'staff'            => 'required|string|max:255',
        ]);

        $vaccination = Vaccination::create($data);

        return response()->json(['status' => 'success', 'vaccination' => $vaccination]);
    }

    public function update(Request $request, $id)
    {
        $vaccination = Vaccination::findOrFail($id);

        $data = $request->validate([
            'animal_id'        => 'required|exists:animals,id',
            'vaccination_date' => 'required|date',
            'vaccine_type'     => 'required|string|max:255',
            'dosage'           => 'required|string|max:255',
            'staff'            => 'required|string|max:255',
        ]);

        $vaccination->update($data);

        return response()->json(['status' => 'success', 'vaccination' => $vaccination]);
    }

    public function destroy($id)
    {
        Vaccination::findOrFail($id)->delete();
        return response()->json(['status' => 'success']);
    }
}
