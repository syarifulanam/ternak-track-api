<?php

namespace App\Http\Controllers;

use App\Models\Cage;
use Illuminate\Http\Request;

class CageController extends Controller
{
    public function index()
    {
        $cages = Cage::latest()->get();
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
        return response()->json(['status' => 'success', 'cage' =>$cage]);
    }

    public function destroy($id)
    {
        Cage::findOrFail($id)->delete();
        return response()->json(['status' => 'success']);
    }
}
