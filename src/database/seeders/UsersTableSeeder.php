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
        // $content = [
        //     'name' => '丸山',
        //     'email' => 'm@m.com',
        //     'password' => Hash::make('00000000'),
        //     'email_verified_at' => CarbonImmutable::today()
        // ];
        // DB::table('users')->insert($content);

        $content = [
            'name' => '佐藤',
            'email' => 's@s.com',
            'password' => Hash::make('99999999'),
            'email_verified_at' => CarbonImmutable::today()
        ];
        DB::table('users')->insert($content);
    }
}
