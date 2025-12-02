<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(EmployeeSeeder::class);
        DB::table('users')->insert([
            [
                'id' => 1001,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('admin123'),
            ]
        ]);
    }
}
