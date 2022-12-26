<?php

namespace Database\Seeders;

use App\Domain\IAM\Models\Role;
use App\Domain\IAM\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::whereName('Super Admin')->first();

        User::updateOrCreate([
            'username' => 'super_admin',
        ], [
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'role_id' => $role->id,
        ]);
    }
}
