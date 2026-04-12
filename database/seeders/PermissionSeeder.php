<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = 
        [
            'createEmployee',
            'deleteEmployee',
            'updateEmployee',
            'createDoc',
            'showDoc',
            'deleteDoc'
        ];

        foreach ($permissions as $perm)
            {
                Permission::create(['name' => $perm]);
            }
    }
}
