<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\Cage;
use Illuminate\Http\Request;

use function Laravel\Prompts\search;

class CageController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');
        $searchCapacity = $request->get('search_capacity');

        $query = Cage::latest();

        if ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }

        if ($searchCapacity) {
            $query->where('capacity', 'LIKE', '%' . $searchCapacity . '%');
        }

        $cages = $query->paginate($perPage);

        $cages->appends($request->query());
        $farms = Farm::all();
        return view('cages.index', compact('cages', 'search', 'searchCapacity', 'farms'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'farm_id'  => 'required|exists:farms,id',
            'name'     => 'required|string|max:255',
            'capacity' => 'required|integer',
        ]);

        $cage = Cage::create($data);
        return response()->json(['status' => 'success', 'cage' => $cage]);
    }

    public function update(Request $request, $id)
    {
        $cage = Cage::findOrFail($id);

        $data = $request->validate([
            'farm_id'  => 'required|exists:farms,id',
            'name'     => 'required|string|max:255|unique:cages,name,' . $id,
            'capacity' => 'required|integer|min:1',
        ]);

        $cage->update($data);

        return response()->json([
            'status' => 'success',
            'cage'   => $cage
        ]);
    }

    public function show($id)
    {
        $customer = Cage::findOrFail($id);
        return response()->json(['status' => 'success', 'cage' => $customer]);
    }

    public function destroy($id)
    {
        Cage::findOrFail($id)->delete();
        return response()->json(['status' => 'success']);
    }
}
