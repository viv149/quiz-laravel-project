<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Define questions and options
        $questions = [
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
        ];

        return view('home', compact('questions'));
    }

    public function quiz(Request $request)
    {
        $questions = $request->input('questions');
        $answers = $request->input('answers');
        $correct = true;

        foreach ($questions as $index => $question) {
            sort($answers[$index]);
            sort($question['answer']);
            if ($answers[$index] !== $question['answer']) {
                $correct = false;
                break;
            }
        }

        if ($correct) {
            return back()->with('message', 'Congratulations! You answered all questions correctly.');
        } else {
            return back()->with('message', 'Some answers are incorrect. Please try again.');
        }
    }
}
