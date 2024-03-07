<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\QuestionCategory;

class QuestionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionCategory::create([
            'category_name' => '집사 고민'
        ]);

        QuestionCategory::create([
            'category_name' => '사료 고민'
        ]);

        QuestionCategory::create([
            'category_name' => '그루밍'
        ]);
    }
}
