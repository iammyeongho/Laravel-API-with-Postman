<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 1) as $index) {

            $date = $faker->dateTimeBetween('-1 years');
            $category = $faker->numberBetween(1, 3);
            $user = $faker->numberBetween(1, 6);
            $question = $faker->numberBetween(1, 6);
            $view = $faker->randomNumber(1);
            // $flg = $faker->randomElement([0,1]);
    

            Comment::create([
                'user_id' => $user,
                'question_id' => $question,
                'comment_contents' => <<<EOT
답변 테스트입니다.
EOT,
                'comment_flg' => '0',
                'created_at' => $date,
            ]);

            $date = $faker->dateTimeBetween('-1 years');
            $category = $faker->numberBetween(1, 3);
            $user = $faker->numberBetween(1, 6);
            $question = $faker->numberBetween(1, 6);
            $view = $faker->randomNumber(1);
            // $flg = $faker->randomElement([0,1]);
    

            Comment::create([
                'user_id' => $user,
                'question_id' => $question,
                'comment_contents' => <<<EOT
답변 테스트입니다.
EOT,
                'comment_flg' => '0',
                'created_at' => $date,
            ]);

            $date = $faker->dateTimeBetween('-1 years');
            $category = $faker->numberBetween(1, 3);
            $user = $faker->numberBetween(1, 6);
            $question = $faker->numberBetween(1, 6);
            $view = $faker->randomNumber(1);
            // $flg = $faker->randomElement([0,1]);
    

            Comment::create([
                'user_id' => $user,
                'question_id' => $question,
                'comment_contents' => <<<EOT
답변 테스트입니다.
EOT,
                'comment_flg' => '0',
                'created_at' => $date,
            ]);

            $date = $faker->dateTimeBetween('-1 years');
            $category = $faker->numberBetween(1, 3);
            $user = $faker->numberBetween(1, 6);
            $question = $faker->numberBetween(1, 6);
            $view = $faker->randomNumber(1);
            // $flg = $faker->randomElement([0,1]);
    

            Comment::create([
                'user_id' => $user,
                'question_id' => $question,
                'comment_contents' => <<<EOT
답변 테스트입니다.
EOT,
                'comment_flg' => '0',
                'created_at' => $date,
            ]);

            $date = $faker->dateTimeBetween('-1 years');
            $category = $faker->numberBetween(1, 3);
            $user = $faker->numberBetween(1, 6);
            $question = $faker->numberBetween(1, 6);
            $view = $faker->randomNumber(1);
            // $flg = $faker->randomElement([0,1]);
    

            Comment::create([
                'user_id' => $user,
                'question_id' => $question,
                'comment_contents' => <<<EOT
답변 테스트입니다.
EOT,
                'comment_flg' => '0',
                'created_at' => $date,
            ]);

            $date = $faker->dateTimeBetween('-1 years');
            $category = $faker->numberBetween(1, 3);
            $user = $faker->numberBetween(1, 6);
            $question = $faker->numberBetween(1, 6);
            $view = $faker->randomNumber(1);
            // $flg = $faker->randomElement([0,1]);
    

            Comment::create([
                'user_id' => $user,
                'question_id' => $question,
                'comment_contents' => <<<EOT
답변 테스트입니다.
EOT,
                'comment_flg' => '0',
                'created_at' => $date,
            ]);
        }
    }
}
