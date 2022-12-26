<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;

class QuestionSeeder extends Seeder
{
    /** @var array<string, string> $lookup */
    private array $lookup = [];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        SimpleExcelReader::create(database_path('data/questions.csv'))
            ->noHeaderRow()
            ->getRows()
            ->each(function ($row) {
                $categoryName = $row[1];
                $difficulty = $row[2];
                $question = $row[3];
                $answer = $row[4];
                $wrongAnswer1 = $row[5];
                $wrongAnswer2 = $row[6];
                $wrongAnswer3 = $row[7];
                $category_id = $this->getCategoryId($categoryName);


                Question::create([
                    'category_id' => $category_id,
                    'difficulty' => $difficulty,
                    'question' => $question,
                    'correct_answer' => $answer,
                    'wrong_answer_1' => $wrongAnswer1,
                    'wrong_answer_2' => $wrongAnswer2,
                    'wrong_answer_3' => $wrongAnswer3,
                ]);
            });
    }

    private function getCategoryId(string $categoryName): string
    {
        if(!isset($this->lookup[$categoryName])) {
            $category = Category::create([
                'name' => $categoryName,
            ]);
            $this->lookup[$categoryName] = $category->id;
            return $category->id;
        }
        return $this->lookup[$categoryName];
    }
}
