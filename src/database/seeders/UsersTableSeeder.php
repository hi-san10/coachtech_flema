<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\CarbonImmutable;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $content = [
            'name' => 'ユーザー1',
            'email' => 'user1@mail.com',
            'password' => Hash::make('11111111'),
            'email_verified_at' => CarbonImmutable::today()
        ];
        DB::table('users')->insert($content);

        $content = [
            'name' => 'ユーザー2',
            'email' => 'user2@mail.com',
            'password' => Hash::make('22222222'),
            'email_verified_at' => CarbonImmutable::today()
        ];
        DB::table('users')->insert($content);

        $content = [
            'name' => 'ユーザー3',
            'email' => 'user3@mail.com',
            'password' => Hash::make('33333333'),
            'email_verified_at' => CarbonImmutable::today()
        ];
        DB::table('users')->insert($content);

        $content = [
            'name' => '丸山',
            'email' => 'm@m',
            'password' => Hash::make('00000000'),
            'email_verified_at' => CarbonImmutable::today()
        ];
        DB::table('users')->insert($content);
    }
}
