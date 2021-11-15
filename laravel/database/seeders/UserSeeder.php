<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Model\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'test2',
            'email' => 'test2@test.jp',
            'password' => Hash::make('password')
        ]);
        factory(User::class)->create([
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'name' => 'test2',
            'email' => 'test2@test.jp',
            'password' => bcrypt('testtest')
        ]);
        factory(User::class, 3)->create();
    }
}
