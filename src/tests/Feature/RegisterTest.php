<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;

class RegisterTest extends TestCase
{
/**
     * カスタムリクエストのバリデーションテスト
     *
     * @param string 項目名
     * @param string 値
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataproviderExample
     */
    public function testExample($item, $data, $expect)
    {
        //入力項目（$item）とその値($data)
        $dataList = [$item => $data];

        $request = new RegisterRequest();
        //フォームリクエストで定義したルールを取得
        $rules = $request->rules();
        //Validatorファサードでバリデーターのインスタンスを取得、その際に入力情報とバリデーションルールを引数で渡す
        $validator = Validator::make($dataList, $rules);
        //入力情報がバリデーショルールを満たしている場合はtrue、満たしていな場合はfalseが返る
        // $result = $validator->passes();
        //期待値($expect)と結果($result)を比較
        // $this->assertEquals($expect, $result);
    }

    public function dataproviderExample()
    {
        return [
            '未入力' => ['name', '', false],
            '必須エラー' => ['password', '11111111', true],
            //str_repeat('a', 256)で、256文字の文字列を作成(aが256個できる)
            '最大文字数エラー' => ['name', str_repeat('a', 256), false],
        ];
    }
}