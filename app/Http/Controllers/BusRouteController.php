<?php
namespace App\Http\Controllers;

use App\Models\BusRoutes;
use App\Models\BusRoutesPoints;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BusRouteController extends Controller
{
    public function index()
    {
        $routes = BusRoutes::with('points')->get();

        return response()->json([
            'success' => true,
            'data' => $routes,
        ]);
    }

    public function show($id)
    {
        $route = BusRoutes::with('points')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $route,
        ]);
    }


    public function generate(Request $request)
    {
        $points = $request->input('points'); // [[lng, lat], ...]

        $response = Http::withHeaders([
            'Authorization' => 'eyJvcmciOiI1YjNjZTM1OTc4NTExMTAwMDFjZjYyNDgiLCJpZCI6IjhiYjkxYTMzOWRiNDQ0YTZiOWVmYzQ0OTMyYTFmNGNhIiwiaCI6Im11cm11cjY0In0='
        ])->post(
                'https://api.openrouteservice.org/v2/directions/driving-car/geojson',
                [
                    'coordinates' => $points
                ]
            );

        return response()->json($response->json());
    }

    public function store(Request $request)
    {
        $route = BusRoutes::create([
            'name' => $request->input('name'),
            'geojson' => json_encode($request->input('geojson')),
        ]);

        foreach ($request->input('points') as $order => $p) {
            BusRoutesPoints::create([
                'bus_route_id' => $route->id,
                'order' => $order,
                'latitude' => $p['coordinates'][1], // lat
                'longitude' => $p['coordinates'][0], // lng
                'type' => $p['type'] ?? 'custom',
            ]);
        }

        return response()->json($route->load('points'));
    }

    public function update(Request $request, $id)
    {
        $route = BusRoutes::findOrFail($id);

        $route->update([
            'name' => $request->input('name', $route->name),
            'geojson' => json_encode($request->input('geojson', json_decode($route->geojson))),
        ]);

        // se vier "points" no request, substitui os pontos existentes
        if ($request->has('points')) {
            $route->points()->delete();

            foreach ($request->input('points') as $order => $p) {
                BusRoutesPoints::create([
                    'bus_route_id' => $route->id,
                    'order' => $order,
                    'latitude' => $p['coordinates'][1],
                    'longitude' => $p['coordinates'][0],
                    'type' => $p['type'] ?? 'custom',
                ]);
            }
        }

        return response()->json($route->load('points'));
    }

    public function destroy($id)
    {
        $route = BusRoutes::findOrFail($id);

        $route->points()->delete();

        $route->delete();

        return response()->json([
            'success' => true,
            'message' => 'Rota removida com sucesso',
        ]);
    }
}
