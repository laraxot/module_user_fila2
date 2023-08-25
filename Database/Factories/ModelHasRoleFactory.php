<?php

declare(strict_types=1);

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use Modules\User\Models\ModelHasRole;

class ModelHasRoleFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = ModelHasRole::class;

    /**
     *
     * Define the model's default state.
     *
     * @return array<int|string>
     *
     * @psalm-return array{role_id: int, model_type: string, model_id: int}
     */
<<<<<<< HEAD
    public function definition()
    {
<<<<<<< HEAD
=======
=======
    public function definition() {

>>>>>>> d9f7748 (up)

>>>>>>> cf6505a (.)
        return [
            'role_id' => $this->faker->randomNumber(5, false),
            'model_type' => $this->faker->word,
            'model_id' => $this->faker->randomNumber(5, false),
        ];
    }
}
