<?php

namespace Database\Factories;

use App\Models\Jobs;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jobs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid'=>$this->faker->uuid,
            'title'=> $this->faker->name,
            'description'=>$this->faker->text,
            'category_id'=>rand(1,10),
            'speciality_id'=>rand(1,10),
            'edit_scope'=>1,
            'time'=>1,
            'level_experience'=>1,
            'user_id'=>rand(1,10),
            'budget'=>rand(10,100)
        ];
    }
}
