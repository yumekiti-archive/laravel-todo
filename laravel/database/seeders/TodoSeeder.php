<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('todos')->insert([
            'title' => 'hoge',
            'detail' => 'hogehogehoge',
            'user_id' => 1,
        ]);
    }
}
