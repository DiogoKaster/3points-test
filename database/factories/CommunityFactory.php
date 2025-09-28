<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Community;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Community>
 */
final class CommunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->company;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph,
        ];
    }
}
