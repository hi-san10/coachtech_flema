<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = [
            'item_id' => 1,
            'buyer_id' => 2,
            'seller_id' => 1,
        ];
        DB::table('transactions')->insert($content);

        $content = [
            'item_id' => 2,
            'buyer_id' => 2,
            'seller_id' => 1,
        ];
        DB::table('transactions')->insert($content);

        $content = [
            'item_id' => 5,
            'buyer_id' => 3,
            'seller_id' => 1,
        ];
        DB::table('transactions')->insert($content);

        $content = [
            'item_id' => 8,
            'buyer_id' => 1,
            'seller_id' => 2,
        ];
        DB::table('transactions')->insert($content);

        $content = [
            'item_id' => 9,
            'buyer_id' => 3,
            'seller_id' => 2,
        ];
        DB::table('transactions')->insert($content);

        $content = [
            'item_id' => 10,
            'buyer_id' => 3,
            'seller_id' => 2,
        ];
        DB::table('transactions')->insert($content);

    }
}
