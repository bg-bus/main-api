<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;

class BusController extends Controller
{
    public function index(Request $request)
{
    $query = Bus::query();

    if ($request->has('empresa') && $request->empresa !== '') {
        $query->where('empresa', 'LIKE', '%' . $request->empresa . '%');
    }

    if ($request->has('placa') && $request->placa !== '') {
        $query->where('placa', 'LIKE', '%' . $request->placa . '%');
    }

    if ($request->has('ordemNumero')) {
        if ($request->ordemNumero === 'asc') {
            $query->orderBy('numero', 'asc');
        } elseif ($request->ordemNumero === 'desc') {
            $query->orderBy('numero', 'desc');
        }
    }

    $buses = $query->get();
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
