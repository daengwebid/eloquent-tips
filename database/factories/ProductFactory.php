<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->sentence;
    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'description' => $faker->paragraph,
        'price' => 100000,
        'status' => 1
    ];
});
