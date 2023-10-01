<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'freemium user']);
        Role::create(['name' => 'paid user']);
        Role::create(['name' => 'enterprise user']);
        Role::create(['name' => 'admin user']);    }
}
