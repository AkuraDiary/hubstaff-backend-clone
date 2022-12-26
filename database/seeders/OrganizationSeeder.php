<?php

namespace Database\Seeders;

use App\Domain\Project\Models\Organization;
use Database\Factories\OrganizationFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organization::factory(15)->create();
    }
}
