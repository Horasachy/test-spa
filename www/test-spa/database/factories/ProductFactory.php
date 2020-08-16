<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'description' => $faker->text,
        'cost' => $faker->randomFloat(10000),
        'count' => random_int(1, 100),
        'external_id' => $faker->unique()->numberBetween(0, 1000),
    ];
});
