<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    public function index()
    {
        $farms = Farm::latest()->get();
        return view('farms.index', compact('farms'));
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
