<?php

namespace Database\Factories;

use App\Domain\IAM\Models\User;
use App\Domain\Project\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class TaskFactory extends Factory
{
         /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $statusArray = ['Done', 'Todo'];

        return [
            'name' => $this->faker->bs(),
            'description' => $this->faker->realText(50, 2),
            'status' => $this->faker->randomElement($statusArray),
            'time_needed' => $this->faker->time(),
            'assigner_id' => 1,
            'assignee_id' => random_int(2, 14),
            'project_id' => $this->faker->randomNumber(1, true),
        ];
    }
}
