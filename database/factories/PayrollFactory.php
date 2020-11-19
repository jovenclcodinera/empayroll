<?php

namespace Database\Factories;

use App\Models\Payroll;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayrollFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payroll::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hours = rand(1, 16);
        $rate = rand(100, 200);
        return [
            'is_overtime' => $hours > 8 ? true : false,
            'is_approved' => $this->faker->boolean(),
            'hours' => $hours,
            'rate' => $rate,
            'gross' => $hours * $rate
        ];
    }
}
