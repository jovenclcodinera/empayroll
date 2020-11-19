<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Unassigned',
            'description' => 'Used when an entity is recently deleted or chosen departments is inconclusive'
        ]);
        Department::factory()->times(5)->create();
    }
}
