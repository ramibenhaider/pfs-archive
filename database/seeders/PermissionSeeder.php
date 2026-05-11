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
            'createEmployees',
            'updateEmployees',
            'deleteEmployees',
            'showEmployees',
            'createDocuments',
            'showDocuments',
            'deleteDocuments',
            'previewDocuments',
        ];

        foreach ($permissions as $perm)
            {
                Permission::create(['name' => $perm]);
            }
    }
}
