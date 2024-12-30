<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = [
            'name' => 'ファッション'
        ];
        DB::table('categories')->insert($content);

        $content = [
            'name' => '家電'
        ];
        DB::table('categories')->insert($content);

        $content = [
            'name' => 'インテリア'
        ];
        DB::table('categories')->insert($content);

        $content = [
            'name' => 'レディース'
        ];
        DB::table('categories')->insert($content);

        $content = [
            'name' => 'メンズ'
        ];
        DB::table('categories')->insert($content);

        $content = [
            'name' => 'コスメ'
        ];
        DB::table('categories')->insert($content);

        $content = [
            'name' => '本'
        ];
        DB::table('categories')->insert($content);

        $content = [
            'name' => 'ゲーム'
        ];
        DB::table('categories')->insert($content);

        $content = [
            'name' => 'スポーツ'
        ];
        DB::table('categories')->insert($content);

        $content = [
            'name' => 'キッチン'
        ];
        DB::table('categories')->insert($content);

        $content = [
            'name' => 'ハンドメイド'
        ];
        DB::table('categories')->insert($content);

        $content = [
            'name' => 'アクセサリー'
        ];
        DB::table('categories')->insert($content);

        $content = [
            'name' => 'おもちゃ'
        ];
        DB::table('categories')->insert($content);

        $content = [
            'name' => 'ベビー・キッズ'
        ];
        DB::table('categories')->insert($content);
    }
}
