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
            'name' => 'まる',
            'email' => 'p@p',
            'password' => Hash::make('00000000'),
            'email_verified_at' => CarbonImmutable::today()
        ];
        DB::table('users')->insert($content);
    }
}
