<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Questions;

class QuestionsSeeder extends Seeder
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

            $date = $faker->dateTimeBetween('-2 years');
            $category = $faker->numberBetween(1, 3);
            $user = $faker->numberBetween(1, 6);
            $view = $faker->randomNumber(1);
            // $flg = $faker->randomElement([0,1]);
    

            Questions::create([
                'category_id' => $category,
                'user_id' => $user,
                'question_title' => '질문 테스트 1',
                'question_contents' => <<<EOT
3달전에 고양이 중성화수술을 했는데 아직까지 오줌실수를 여기저기 해요ㅠㅠ 
화장실도 가긴 하는데 아무대서나도 자주싸요 고칠 방법이 있을까요?
EOT,
                'question_view' => $view,
                'created_at' => $date,
            ]);

            $date = $faker->dateTimeBetween('-2 years');
            $category = $faker->numberBetween(1, 3);
            $user = $faker->numberBetween(1, 6);
            $view = $faker->randomNumber(2);
            $flg = $faker->randomElement([0,1]);
    

            Questions::create([
                'category_id' => $category,
                'user_id' => $user,
                'question_title' => '질문 테스트 2',
                'question_contents' => <<<EOT
아까부터 창문 앞에서 꼬리 흔들면서 갸갸갹 거리고 있네요 ㅋㅋㅋ 
아까 날파리 있던데 그래서 그런가봐요 ㅋㅋㅋ 
심장폭행😻😻😻갑자기 털도 세우네용 ㅋㅋㅋㅋ(날파리 잡기에 진심)
EOT,
                'question_view' => $view,
                'created_at' => $date,
            ]);

            $date = $faker->dateTimeBetween('-2 years');
            $category = $faker->numberBetween(1, 3);
            $user = $faker->numberBetween(1, 6);
            $view = $faker->randomNumber(2);
            $flg = $faker->randomElement([0,1]);
    

            Questions::create([
                'category_id' => $category,
                'user_id' => $user,
                'question_title' => '질문 테스트 3',
                'question_contents' => <<<EOT
오늘 제가 컴퓨터 하다가 레오를 보니…! 
제 패딩 위에서 자고 있었어용!!!! 
근데 너무 잘 자는지 눈을 치켜뜨고 자네용 ㅋㅋㅋ
EOT,
                'question_view' => $view,
                'created_at' => $date,
            ]);

            $date = $faker->dateTimeBetween('-2 years');
            $category = $faker->numberBetween(1, 3);
            $user = $faker->numberBetween(1, 6);
            $view = $faker->randomNumber(2);
            $flg = $faker->randomElement([0,1]);
    

            Questions::create([
                'category_id' => $category,
                'user_id' => $user,
                'question_title' => '질문 테스트 4',
                'question_contents' => <<<EOT
지난봄에 찍은 사진인데 일명 꽃개사진! 이에요
너무 예쁘죠??
꽃이 필때는 시간이 정말 빨리 가고 생각보다 자주 못놀러다니는게 미안했는데
24년 봄에는 쎄이를 더 사랑해줘야겠다는 다짐을 해봅니다!
EOT,
                'question_view' => $view,
                'created_at' => $date,
            ]);

            $date = $faker->dateTimeBetween('-2 years');
            $category = $faker->numberBetween(1, 3);
            $user = $faker->numberBetween(1, 6);
            $view = $faker->randomNumber(2);
            $flg = $faker->randomElement([0,1]);
    

            Questions::create([
                'category_id' => $category,
                'user_id' => $user,
                'question_title' => '질문 테스트 5',
                'question_contents' => <<<EOT
시골집이라 고양이가 반 집냥이 반 길냥이입니다. 
어느날 돌아다니더니 감기를 걸려왔더군요 눈물콧물이 줄줄 나오고 콧물때문에 숨이막혀 헐떡댑니다.. 
그리고 고양이가 좀 많이 꼬질꼬질한데 씻겨줘야할까요? 아무래도 몸이 더러우면 증상이 악화될꺼같아서요..
씻겨주면 스트레스받고 추워서 더 안좋을까요? ㅜㅜ
EOT,
                'question_view' => $view,
                'created_at' => $date,
            ]);

            $date = $faker->dateTimeBetween('-2 years');
            $category = $faker->numberBetween(1, 3);
            $user = $faker->numberBetween(1, 6);
            $view = $faker->randomNumber(2);
            $flg = $faker->randomElement([0,1]);
    

            Questions::create([
                'category_id' => $category,
                'user_id' => $user,
                'question_title' => '질문 테스트 6',
                'question_contents' => <<<EOT
쎄이를 키우기전에는 엄마아빠가 무슨 고양이유모차냐
호들갑 떨지말아라 창피해서 나는 절대 ~~~ 못 끌고나간다
맨날 이러셨거든요 ㅋㅋㅋ
근데 쎄이 다리 아플까봐 먼저유모차 챙기시는 모습이 정말감동인거같아요
EOT,
                'question_view' => $view,
                'created_at' => $date,
            ]);
        }
    }
}
