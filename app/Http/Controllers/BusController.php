<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\models\Bus;

class BusController extends Controller
{
    public function index() {
        // return view()
    }

    public function create(Request $request) {
        $bus = $request->all();
        Bus::create($bus);
        return response()->json($bus, 200);
    }
    
}
