<?php

namespace Database\Factories;

use App\Models\JobPreference;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobPreferenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobPreference::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $english = array('any', 'better', 'fluent', 'native');
        $english_level=array_rand($english,1);

        $hours = array('30plus', '30minus', '0');
        $hours_per_week=array_rand($hours,1);

        $hire = array('1-3', '1 week', '2 weeks', '1 month');
        $hire_date=array_rand($hire,1);

        $pro = array('1', '1plus');
        $no_of_professionals=array_rand($pro,1);

        return [
             'english_level'=>$english[$english_level],
             'hours_per_week' => $hours[$hours_per_week],
             'hire_date'=> $hire[$hire_date],
             'no_of_professionals'=>$pro[$no_of_professionals],
             'type_of_talent'=>"independent",
             'location'=>rand(0,100)
        ];
    }
}
