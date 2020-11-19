<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Database\Seeder;
use Thomaswelton\LaravelGravatar\Facades\Gravatar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create()->each(function(User $user) {
            if (Gravatar::exists($user->email)) {
                $avatarUrl = Gravatar::src($user->email);
            } else {
                $avatarUrl = null;
            }
            Employee::factory()->create([
                'user_id' => $user->id,
                'avatar_url' => $avatarUrl
            ])->each(function(Employee $employee) {
                Payroll::factory()->count(rand(1, 20))->create(['employee_id' => $employee->id]);
            });
        });
    }
}
