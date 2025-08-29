<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@bgbus.com',
            'password' => Hash::make('admin123'),
            'type_id' => 1, // Supondo que 1 seja Admin
        ]);
        // Operador
        User::create([
            'name' => 'Operator User',
            'email' => 'operator@bgbus.com',
            'password' => Hash::make('operator123'),
            'type_id' => 2, // Supondo que 2 seja Operador
        ]);
        // Passageiro
        User::create([
            'name' => 'Passenger User',
            'email' => 'passenger@bgbus.com',
            'password' => Hash::make('passenger123'),
            'type_id' => 3, // Supondo que 3 seja Passageiro
        ]);
    }
}
