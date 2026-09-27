<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => rtrim(fake()->sentence(6), '.'),
            'content' => implode(
                "\n\n",
                fake()->paragraphs(fake()->numberBetween(7, 18))
            ),
            'published_at' => fake()
                ->dateTimeBetween('-1 year', 'now')
                ->format('Y-m-d'),
            'author_name' => fake()->name(),
            'author_email' => fake()->safeEmail(),
        ];
    }
}
