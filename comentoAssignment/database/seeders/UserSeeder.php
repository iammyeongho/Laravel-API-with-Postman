<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

class UserSeeder extends Seeder
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

            User::create([
                'user_social_id' => 'ykxv317@gmail.com',
                'user_state' => '0',
                'user_kind' => '코리안 숏헤어',
                'user_age' => 5,
                'created_at' => $date,
            ]);

            $date = $faker->dateTimeBetween('-1 years');

            User::create([
                'user_social_id' => 'nfvh729@gmail.com',
                'user_state' => '0',
                'user_kind' => '시바견',
                'user_age' => 6,
                'created_at' => $date,
            ]);

            $date = $faker->dateTimeBetween('-1 years');

            User::create([
                'user_social_id' => 'aroq141@naver.com',
                'user_state' => '0',
                'user_kind' => '스코티쉬 폴드',
                'user_age' => 11,
                'created_at' => $date,
            ]);

            $date = $faker->dateTimeBetween('-1 years');

            User::create([
                'user_social_id' => 'sjdk983@daum.net',
                'user_state' => '0',
                'user_kind' => '도베르만',
                'user_age' => 1,
                'created_at' => $date,
            ]);

            $date = $faker->dateTimeBetween('-1 years');

            User::create([
                'user_social_id' => 'igzm856@gmail.com',
                'user_state' => '0',
                'user_kind' => '뱅갈',
                'user_age' => 3,
                'created_at' => $date,
            ]);

            $date = $faker->dateTimeBetween('-1 years');

            User::create([
                'user_social_id' => 'xjrp248@gmail.com',
                'user_state' => '0',
                'user_kind' => '먼치킨',
                'user_age' => 14,
                'created_at' => $date,
            ]);
        }
    }
}
