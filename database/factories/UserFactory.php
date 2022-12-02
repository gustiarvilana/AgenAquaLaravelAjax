<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => 'Gustiar arief Vilana',
            'username' => 'admin',
            'nik' => '99',
            'jabatan' => '99',
            'email' => 'guztiar.profile@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'), // password
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
