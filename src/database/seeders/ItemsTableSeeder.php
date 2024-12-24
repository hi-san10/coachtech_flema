<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
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
            'name' => '腕時計',
            'price' => '15000',
            'detail' => 'スタイリッシュなデザインのメンズ腕時計',
            'condition' => '良好',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg'
        ];
        DB::table('items')->insert($content);

        $content = [
            'user_id' => '1',
            'name' => 'HDD',
            'price' => '5000',
            'detail' => '高速で信頼性の高いハードディスク',
            'condition' => '目立った傷や汚れなし',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg'
        ];
        DB::table('items')->insert($content);

        $content = [
            'user_id' => '1',
            'name' => '玉ねぎ3束',
            'price' => '300',
            'detail' => '新鮮な玉ねぎ3束のセット',
            'condition' => 'やや傷や汚れあり',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg'
        ];
        DB::table('items')->insert($content);

        $content = [
            'user_id' => '1',
            'name' => '靴革',
            'price' => '4000',
            'detail' => 'クラシックなデザインの革靴',
            'condition' => '状態が悪い',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg'
        ];
        DB::table('items')->insert($content);

        $content = [
            'user_id' => '1',
            'name' => 'ノートPC',
            'price' => '45000',
            'detail' => '高性能なノートパソコン',
            'condition' => '良好',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg'
        ];
        DB::table('items')->insert($content);

        $content = [
            'user_id' => '1',
            'name' => 'マイク',
            'price' => '8000',
            'detail' => '高音質のレコーディング用マイク',
            'condition' => '目立った傷や汚れなし',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg'
        ];
        DB::table('items')->insert($content);

        $content = [
            'user_id' => '1',
            'name' => 'ショルダーバッグ',
            'price' => '3500',
            'detail' => 'おしゃれなショルダーバッグ',
            'condition' => 'やや傷や汚れあり',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg'
        ];
        DB::table('items')->insert($content);

        $content = [
            'user_id' => '1',
            'name' => 'タンブラー',
            'price' => '500',
            'detail' => '使いやすいタンブラー',
            'condition' => '状態が悪い',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg'
        ];
        DB::table('items')->insert($content);

        $content = [
            'user_id' => '1',
            'name' => 'コーヒーミル',
            'price' => '4000',
            'detail' => '手動のコーヒーミル',
            'condition' => '良好',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg'
        ];
        DB::table('items')->insert($content);

        $content = [
            'user_id' => '1',
            'name' => 'メイクセット',
            'price' => '2500',
            'detail' => '便利なメイクアップセット',
            'condition' => '目立った傷や汚れなし',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg'
        ];
        DB::table('items')->insert($content);

    }
}
