<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Community::create([
            'user_id' => 2,
            'image' => "/images/1oMVB0xQPtNNLPiZpPX6HnQewYXzrlkLXkscMNRp.png",
            'name' => 'testin communty',
            'address' => fake()->address(),
            'desc' => fake()->text(),
            'phone' => '080823954848',
        ]);
        Community::create([
            'user_id' => 2,
            'image' => "/images/1oMVB0xQPtNNLPiZpPX6HnQewYXzrlkLXkscMNRp.png",
            'name' => 'testin communty',
            'address' => fake()->address(),
            'desc' => fake()->text(),
            'phone' => '080823954848',
        ]);
        Community::create([
            'user_id' => 2,
            'image' => "/images/1oMVB0xQPtNNLPiZpPX6HnQewYXzrlkLXkscMNRp.png",
            'name' => 'testin communty',
            'address' => fake()->address(),
            'desc' => fake()->text(),
            'phone' => '080823954848',
        ]);
    }
}
