<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'code' => 'SQD1',
                'text' => 'I am satisfied with the service I received.',
                'is_active' => true,
            ],
            [
                'code' => 'SQD2',
                'text' => 'I spent a reasonable amount of time for my transaction.',
                'is_active' => true,
            ],
            [
                'code' => 'SQD3',
                'text' => 'The office/facility had the materials, equipment, and/or documents needed for my transaction.',
                'is_active' => true,
            ],
            [
                'code' => 'SQD4',
                'text' => 'I paid a reasonable amount of fees for my transaction.',
                'is_active' => true,
            ],
            [
                'code' => 'SQD5',
                'text' => 'I was able to complete my transaction without going to other offices.',
                'is_active' => true,
            ],
            [
                'code' => 'SQD6',
                'text' => 'I was treated courteously by the staff.',
                'is_active' => true,
            ],
            [
                'code' => 'SQD7',
                'text' => 'The staff were able to answer my questions completely.',
                'is_active' => true,
            ],
            [
                'code' => 'SQD8',
                'text' => 'I was able to complete my transaction in the promised time.',
                'is_active' => true,
            ],
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
