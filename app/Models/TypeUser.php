<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeUser extends Model
{
    use HasFactory;

    protected $table = 'type_users';

    protected $fillable = [
        'type',
        'description',
        'access_routes',
        'active',
    ];

    protected $casts = [
        'access_routes' => 'array',
        'active' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'type_id');
    }
}
