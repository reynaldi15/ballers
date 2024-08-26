<?php

namespace Database\Seeders;

use App\Models\BasketballField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BasketballFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BasketballField::create([
            'user_id' => 3,
            'title' => 'basketball field 1',
            'image' => "/images/1oMVB0xQPtNNLPiZpPX6HnQewYXzrlkLXkscMNRp.png",
            'price' => '10000',
            'address' => fake()->address(),
            'desc' => fake()->text(),
            'date' => date('Y-m-d'),
            'start_time' => date('H:i:s'),
            'end_time' => date('H:i:s', strtotime('+1 hour')),
        ]);
        BasketballField::create([
            'user_id' => 3,
            'title' => 'basketball field 2',
            'image' => "/images/1oMVB0xQPtNNLPiZpPX6HnQewYXzrlkLXkscMNRp.png",
            'price' => '10000',
            'address' => fake()->address(),
            'desc' => fake()->text(),
            'date' => date('Y-m-d'),
            'start_time' => date('H:i:s'),
            'end_time' => date('H:i:s', strtotime('+1 hour')),
        ]);
        BasketballField::create([
            'user_id' => 3,
            'title' => 'basketball field 3',
            'image' => "/images/1oMVB0xQPtNNLPiZpPX6HnQewYXzrlkLXkscMNRp.png",
            'price' => '10000',
            'address' => fake()->address(),
            'desc' => fake()->text(),
            'date' => date('Y-m-d'),
            'start_time' => date('H:i:s'),
            'end_time' => date('H:i:s', strtotime('+1 hour')),
        ]);
    }
}
