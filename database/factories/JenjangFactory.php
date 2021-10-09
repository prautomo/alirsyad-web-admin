<?php

namespace Database\Factories;

use App\Models\Jenjang;
use Illuminate\Database\Eloquent\Factories\Factory;

class JenjangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jenjang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "description" => "Description"
        ];
    }
}
