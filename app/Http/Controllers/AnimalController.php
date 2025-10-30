<?php

namespace App\Http\Controllers;

use App\Models\Cage;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search_qr = $request->get('search_qr');
        $search_species = $request->get('search_species');

        $query = Animal::with('cage')->latest();

        if ($search_qr) {
            $query->where('qr_code', 'LIKE', '%' . $search_qr . '%');
        }

        if ($search_species) {
            $query->where('species', 'LIKE', '%' . $search_species . '%');
        }

        $cages = Cage::orderBy('name')->get();

        $animals = $query->paginate($perPage);

        $animals->appends($request->query());
        $cages = Cage::orderBy('name')->get();
        return view('animals.index', compact('animals', 'search_qr', 'search_species', 'cages'));
    }

    public function show($id)
    {
        $animal = Animal::with('cage')->findOrFail($id);
        return response()->json(['status' => 'success', 'animal' => $animal]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'qr_code'    => 'required|string|max:255|unique:animals,qr_code',
            'code_animal' => 'required|string|max:50|unique:animals,code_animal',
            'species'    => 'required|in:buffalo,goat',
            'birth_date' => 'required|date',
            'gender'     => 'required|in:male,female',
            'status'     => 'required|in:alive,dead',
            'cage_id'    => 'required|exists:cages,id',
        ]);

        $animal = Animal::create($data);

        return response()->json(['status' => 'success', 'animal' => $animal]);
    }

    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);

        $data = $request->validate([
            'qr_code'    => 'required|string|max:255|unique:animals,qr_code,' . $animal->id,
            'code_animal' => 'required|string|max:50|unique:animals,code_animal,' .  $animal->id,
            'species'    => 'required|in:buffalo,goat',
            'birth_date' => 'required|date',
            'gender'     => 'required|in:male,female',
            'status'     => 'required|in:alive,dead',
            'cage_id'    => 'required|exists:cages,id',
        ]);

        $animal->update($data);

        return response()->json(['status' => 'success', 'animal' => $animal]);
    }

    public function destroy($id)
    {
        Animal::findOrFail($id)->delete();
        return response()->json(['status' => 'success']);
    }
}
