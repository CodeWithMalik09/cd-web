<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'developer']);
        Role::create(['name'=>'operator']);
        Role::create(['name'=>'viewer']);
    }
}
