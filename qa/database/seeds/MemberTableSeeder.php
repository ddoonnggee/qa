<?php

use Illuminate\Database\Seeder;
use App\Models\Member;
use Illuminate\Support\Facades\Redis;

class MemberTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
            for($i = 0; $i < 100000; $i++){
                $count      = mt_rand(500, 3000);
                $draw_count = mt_rand(0, 50);
                $win_count  = $faker->numberBetween(0, $count - $draw_count);
                $lose_count = $count - $win_count - $draw_count;
                $name       = $faker->userName;
                $score      = $win_count * 20;

                $member = Member::create([
                    'nickname'   => $name,
                    'avatar'     => $faker->imageUrl($width = 80, $height = 80),
                    'score'      => $win_count * 20,
                    'count'      => $count,
                    'win_count'  => $win_count,
                    'lose_count' => $lose_count,
                    'draw_count' => $draw_count
                ]);

                $data = $member->id.'_'.$name.'_'.$score.'_'.$count.'_'.$win_count.'_'.$lose_count.'_'.$draw_count;
                Redis::zAdd('member_rank', $score, $data);
            }
    }
}
