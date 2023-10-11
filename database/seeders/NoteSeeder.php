<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('notes')->insert([
            [
                'title' => 'シーダー',
                'content' => 'シーダーだよ',
                'tag_id' => random_int(1, 3),
                'user_id' => 1,
                'status' => 1,
            ],
            [
                'title' => 'シーダー2',
                'content' => '2シーダーめだよ',
                'tag_id' => random_int(1, 3),
                'user_id' => 1,
                'status' => 1,
            ]

        ]);
    }
}
