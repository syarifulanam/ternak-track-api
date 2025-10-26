<?php

namespace App\Http\Controllers;

use App\Models\Cage;
use Illuminate\Http\Request;

class CageController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $cages = Cage::latest()->paginate($perPage);

        $cages->appends($request->query());
        return view('cages.index', compact('cages'));
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
