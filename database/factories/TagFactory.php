<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Tag::class, function (Faker $faker) {
    $name = $faker->sentence(3);

    return [
        'name' => $name,
        'slug' => str_slug($name, '-').'-'.time().'-'.mt_rand(0, 100),
        'description' => $faker->paragraph,
    ];
});
