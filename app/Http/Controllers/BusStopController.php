<?php

namespace App\Http\Controllers;

use App\Models\BusStop;
use Illuminate\Http\Request;

class BusStopController extends Controller
{

    public function index()
    {
        return response()->json(BusStop::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'adress' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        $busStop = BusStop::create($validated);
        return response()->json($busStop, 201);
    }

    public function show($id)
    {
        $busStop = BusStop::findOrFail($id);
        return response()->json($busStop);
    }

    public function update(Request $request, $id)
    {
        $busStop = BusStop::findOrFail($id);
        $validated = $request->validate([
            'na me' => 'sometimes|required|string',
            'adress' => 'sometimes|required|string',
            'latitude' => 'sometimes|required|numeric',
            'longitude' => 'sometimes|required|numeric',
        ]);
        $busStop->update($validated);
        return response()->json($busStop);
    }

    public function destroy($id)
    {
        $busStop = BusStop::findOrFail($id);
        $busStop->delete();
        return response()->json(['message' => 'Ponto de ônibus removido com sucesso.']);
    }
}
