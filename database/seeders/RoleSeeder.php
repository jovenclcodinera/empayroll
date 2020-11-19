<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => Uuid::uuid4()->toString(),
                'title' => 'ADMIN',
                'description' => 'Access to all application functions',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'title' => 'EMPLOYEE',
                'description' => 'Limited access to data and application functions',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'title' => 'TESTER',
                'description' => 'Access to all application functions & can modify the application for testing',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'title' => 'UNASSIGNED',
                'description' => 'Used when an entity is recently deleted or chosen role is inconclusive',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
