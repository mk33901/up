<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' =>$this->faker->name,
            'description'=>$this->faker->text,
            'company_name'=>$this->faker->name,
            'company_website'=>$this->faker->url,
            'company_tag_line'=>$this->faker->name,
            'company_description'=>$this->faker->text,
            'company_owner'=>$this->faker->name,
            'company_phone'=>"123456",
            'company_vat'=>null,
            'company_timezone'=>null,
            'company_country'=>$this->faker->country,
            'company_address'=>$this->faker->address,
            'company_city'=>$this->faker->city,
            'company_zip'=>$this->faker->postcode,
        ];
    }
}
