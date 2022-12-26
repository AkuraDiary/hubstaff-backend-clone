<?php

namespace Database\Seeders;

use App\Domain\IAM\Models\Role;
use App\Domain\IAM\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(15)->create();
    }
}
