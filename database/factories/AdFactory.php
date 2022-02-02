<?php

namespace Database\Factories;

use App\Enums\TypeEnum;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        Category::factory(1)->create();
        User::factory(1)->create();

        return [
            'type'=> TypeEnum::PAID,
            'title' => $this->faker->name(),
            'description' => $this->faker->text,
            'start_date' => now(),
            'advertiser_id' => 1,
            'category_id' => 1
        ];
    }
}
