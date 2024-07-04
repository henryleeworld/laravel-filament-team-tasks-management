<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        Role::create(['name' => 'user']);
        Role::create(['name' => 'team administrator']);
        Role::create(['name' => 'super administrator']);
    }
}
