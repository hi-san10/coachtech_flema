<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TransactionMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = [
            'transaction_id' => 1,
            'user_id' => 2,
            'message' => '商品を購入しました'
        ];
        DB::table('transaction_messages')->insert($content);

        $content = [
            'transaction_id' => 2,
            'user_id' => 2,
            'message' => '商品を購入しました'
        ];
        DB::table('transaction_messages')->insert($content);

        $content = [
            'transaction_id' => 3,
            'user_id' => 3,
            'message' => '商品を購入しました'
        ];
        DB::table('transaction_messages')->insert($content);

        $content = [
            'transaction_id' => 4,
            'user_id' => 1,
            'message' => '商品を購入しました'
        ];
        DB::table('transaction_messages')->insert($content);

        $content = [
            'transaction_id' => 5,
            'user_id' => 3,
            'message' => '商品を購入しました'
        ];
        DB::table('transaction_messages')->insert($content);

        $content = [
            'transaction_id' => 6,
            'user_id' => 3,
            'message' => '商品を購入しました'
        ];
        DB::table('transaction_messages')->insert($content);

    }
}
