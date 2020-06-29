<?php

use App\Question;
use Illuminate\Database\Seeder;
use QuestionsSeeder as QuestionSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([
        //     AdminDataInfo::class,
        // ]);
        $this->call([QuestionSeeder::class]);
    }
}
