<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');
        $searchOwner = $request->get('search_owner');

        $query = Farm::latest();

        if ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }

        if ($searchOwner) {
            $query->where('owner', 'LIKE', '%' . $searchOwner . '%');
        }

        $farms = $query->paginate($perPage);

        $farms->appends($request->query());
        return view('farms.index', compact('farms', 'search', 'searchOwner'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255|unique:farms,name',
            'address' => 'required|string|max:255',
            'owner'   => 'required|string|max:255',
        ]);

        $farm = Farm::create($data);

        return response()->json(['status' => 'success', 'farms' => $farm]);
    }

    public function show($id)
    {
        $farm = Farm::findOrFail($id);
        return response()->json(['status' => 'success', 'farm' => $farm]);
    }

    public function update(Request $request, $id)
    {
        $farm = Farm::findOrFail($id);

        $data = $request->validate([
            'name'    => 'required|string|max:255|unique:farms,name,' . $id,
            'address' => 'required|string|max:255',
            'owner'   => 'required|string|max:255',
        ]);

        $farm->update($data);

        return response()->json(['status' => 'success', 'farms' => $farm]);
    }

    public function destroy($id)
    {
        Farm::findOrFail($id)->delete();
        return response()->json(['status' => 'success']);
    }
}
