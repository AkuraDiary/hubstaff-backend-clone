<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Project\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::factory(20)->create();
    }
}
