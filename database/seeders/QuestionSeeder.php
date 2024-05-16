<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Question::factory()->create([
            [
                'question' => 'Which of the following methods are used to redirect users in Laravel?',
                'options' => ['back', 'route', 'view', 'to'],
                'answer' => ['back', 'route', 'to']
            ],
            [
                'question' => 'Which of the following are HTTP methods supported by Laravel?',
                'options' => ['GET', 'POST', 'FETCH', 'DELETE'],
                'answer' => ['GET', 'POST', 'DELETE']
            ],
            [
                'question' => 'Which of the following are common Blade directives?',
                'options' => ['@if', '@include', '@route', '@foreach'],
                'answer' => ['@if', '@include', '@foreach']
            ]
        ]);
    }
}
