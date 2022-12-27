<?php

namespace Database\Seeders;

use App\Domain\IAM\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleName = ['Project Manager', 'Employee'];
        foreach ($roleName as $data) {
            Role::create(['name' => $data]);
        }
    }
}
