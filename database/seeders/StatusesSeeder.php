<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users_id = ['1','2','8','9','10'];
        $statuses = Status::factory()->times(100)->make()->each(function ($status) use  ($users_id) {
            $status->user_id = fake()->randomElement($users_id);
        });

        Status::insert($statuses->toArray());
    }
}
