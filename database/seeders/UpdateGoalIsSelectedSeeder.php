<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Goal;

class UpdateGoalIsSelectedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // 特定のゴールの is_selected を更新
        $goal = Goal::find(1); // ここで更新したいレコードのIDを指定
        $goal->is_selected = 1;
        $goal->save();
    }
}
