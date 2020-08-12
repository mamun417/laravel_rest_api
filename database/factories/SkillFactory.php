<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Skill;
use Faker\Generator as Faker;

$factory->define(Skill::class, function (Faker $faker) {
    $name = $faker->unique()->firstNameMale;

    return [
        'name' => ucfirst($name)
    ];
});
