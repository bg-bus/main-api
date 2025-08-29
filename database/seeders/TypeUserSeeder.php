<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TypeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_users')->insert([
            [
                'type' => 'admin',
                'access_routes' => json_encode([
                    '/admin',
                    '/admin/bus-routes',
                    '/admin/bus-routes/form',
                    '/admin/bus-stops',
                    '/admin/bus-stops/form',
                ]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'manager',
                'access_routes' => json_encode([
                    '/admin/bus-routes',
                    '/admin/bus-stops',
                ]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'user',
                'access_routes' => json_encode(['']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),                                                                                                              
            ],
        ]);
    }
}
