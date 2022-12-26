<?php

namespace Database\Factories;

use App\Domain\Project\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class ProjectFactory extends Factory
{
         /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->bs(),
            'description' => $this->faker->realText(50, 2),
            'organization_id' => $this->faker->randomNumber(1, true),
        ];
    }
}
