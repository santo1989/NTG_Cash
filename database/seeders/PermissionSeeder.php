<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{

    public function run()
    {
        Permission::create([
            'name' => 'Create'
        ]);

        Permission::create([
            'name' => 'Edit'
        ]);

        Permission::create([
            'name' => 'Delete'
        ]);

        Permission::create([
            'name' => 'View'
        ]);

        Permission::create([
            'name' => 'Approve'
        ]);

        Permission::create([
            'name' => 'Reject'
        ]);

    }
}
