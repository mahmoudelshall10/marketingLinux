<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::create([
            'question' => 'Question 1'
        ]);
        Question::create([
            'question' => 'Question 2'
        ]);
        Question::create([
            'question' => 'Question 3'
        ]);
    }
}
