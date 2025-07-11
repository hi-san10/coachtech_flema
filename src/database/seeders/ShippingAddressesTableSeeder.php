<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingAddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = [
            'profile_id' => '1',
            'post_code' => '111-1111',
            'address' => 'japan'
        ];
        DB::table('shipping_addresses')->insert($content);

        $content = [
            'profile_id' => '2',
            'post_code' => '222-2222',
            'address' => 'usa'
        ];
        DB::table('shipping_addresses')->insert($content);

        $content = [
            'profile_id' => '3',
            'post_code' => '333-3333',
            'address' => 'italy'
        ];
        DB::table('shipping_addresses')->insert($content);
    }
}
