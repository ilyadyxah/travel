<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'target_id' => $this->faker->numberBetween(1,10),
            'target_table_id' => $this->faker->numberBetween(1,3),
            'user_id' => $this->faker->numberBetween(1,2),
            'message' => $this->faker->text(10),

        ];
    }
}
