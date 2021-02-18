<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'status' => $faker->boolean,
        'name' => $faker->unique()->name,
        'description' => $faker->text,
        'price' => $faker->numberBetween(200, 300),
        'image' => $faker->imageUrl(),
    ];
});
