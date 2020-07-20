<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;

$factory->define(User::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'name' => $faker->name,
        'password' => Hash::make('1234'),
        'email_verified_at' => \Carbon\Carbon::now()
    ];
});
