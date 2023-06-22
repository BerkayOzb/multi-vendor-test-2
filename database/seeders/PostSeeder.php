<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            'image' => 'storage/uploads/1687168155_xx.jpg',
            'title' => Str::random(22),
            'description' => Str::random(50),
            'category_id' => rand(1,5)
        ]);
    }
}
