<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::all();
        return response()->json($buses);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'placa' => 'required|string|max:20',
            'numero' => 'required|integer',
            'empresa' => 'required|string|max:100',
        ]);

        $bus = Bus::create($validated);
        return response()->json($bus, 201);
    }

    public function update(Request $request, $id)
    {
        $bus = Bus::findOrFail($id);

        $validated = $request->validate([
            'placa' => 'required|string|max:20',
            'numero' => 'required|integer',
            'empresa' => 'required|string|max:100',
        ]);

        $bus->update($validated);
        return response()->json($bus, 200);
    }

    public function delete($id)
    {
        $bus = Bus::findOrFail($id);
        $bus->delete();

        return response()->json(['message' => 'Ônibus excluído com sucesso'], 200);
    }
}
