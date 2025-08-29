<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusRoutes extends Model
{
    protected $fillable = ['name', 'geojson'];

    public function points()
    {
        return $this->hasMany(BusRoutesPoints::class, 'bus_route_id');
    }
}
