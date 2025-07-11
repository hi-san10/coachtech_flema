<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = [
            'user_id' => '1',
            'name' => 'user1',
            'post_code' => '111-1111',
            'address' => 'japan',
            'image' => '/images/user1.jpg'
        ];
        DB::table('profiles')->insert($content);

        $content = [
            'user_id' => '2',
            'name' => 'user2',
            'post_code' => '222-2222',
            'address' => 'usa',
            'image' => '/images/user2.jpg'
        ];
        DB::table('profiles')->insert($content);

        $content = [
            'user_id' => '3',
            'name' => 'user3',
            'post_code' => '333-3333',
            'address' => 'italy',
            'image' => '/images/user2.jpg'
        ];
        DB::table('profiles')->insert($content);
    }
}
