<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', '!=', UserRole::ADMIN->value)
            ->inRandomOrder()->first()?->id,
            'project_name' => $this->faker->sentence(3), // Nama proyek
            'description' => $this->faker->paragraph(),  // Deskripsi proyek
        ];
    }
}
