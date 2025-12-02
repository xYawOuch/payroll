<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Employee::insert([
            [
                'name' => 'Juan Dela Cruz',
                'salary' => 20000,
                'late_minutes' => 15,
                'undertime_minutes' => 10,
                'half_days' => 0,
                'leave_without_pay_days' => 0,
            ],
            [
                'name' => 'Maria Santos',
                'salary' => 25000,
                'late_minutes' => 0,
                'undertime_minutes' => 45,
                'half_days' => 1,
                'leave_without_pay_days' => 0,
            ],
            [
                'name' => 'Pedro Reyes',
                'salary' => 18000,
                'late_minutes' => 5,
                'undertime_minutes' => 0,
                'half_days' => 0,
                'leave_without_pay_days' => 1,
            ],
        ]);
    }
}
