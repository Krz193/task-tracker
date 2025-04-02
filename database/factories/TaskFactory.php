<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Project;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_name' => $this->faker->sentence(4),
            'status' => $this->faker->randomElement(TaskStatus::cases())->value,
            'description' => $this->faker->paragraph(),
            'user_id' => User::inRandomOrder()->first()?->id, // Random user
            'project_id' => Project::inRandomOrder()->first()?->id, // Random project
        ];
    }
}
