<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusRoutesPoints extends Model
{
    protected $fillable = ['bus_route_id', 'order', 'latitude', 'longitude', 'type'];

    public function route()
    {
        return $this->belongsTo(BusRoutes::class, 'bus_route_id');
    }

}
