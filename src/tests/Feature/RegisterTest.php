<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @dataProvider validationProvider
     * @return void
     */
    public function testRegisterValidation($inData, $outFail, $outMessage)
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $request = new RegisterRequest();
        $rules = $request->rules();
        $messages = $request->messages();
        $validator = Validator::make($inData, $rules, $messages);
        $result = $validator->fails();
        $this->assertEquals($outFail, $result);
        $messages = $validator->errors()->getMessages();
        $this->assertEquals($outMessage, $messages);
    }

    public function validationProvider()
    {
        return [
            'name_empty' => [
                [
                    'name' => '',
                    'email' => 'aaaa@example.com',
                    'password' => '12345678',
                    'password_confirmation' => '12345678'
                ],
                true,
                [
                    'name' => ['お名前を入力してください'],
                ],
            ],
            'email_empty' => [
                [
                    'name' => 'aaa',
                    'email' => '',
                    'password' => '12345678',
                    'password_confirmation' => '12345678'

                ],
                true,
                [
                    'email' => ['メールアドレスを入力してください'],
                ],
            ],
            'password_empty' => [
                [
                    'name' => 'aaa',
                    'email' => 'aaaa@example.com',
                    'password' => '',
                    'password_confirmation' => '12345678'
                ],
                true,
                [
                    'password' => ['パスワードを入力してください'],
                ],
            ],
            'password_mismatch' => [
                [
                    'name' => 'aaa',
                    'email' => 'aaaa@example.com',
                    'password' => '12345678',
                    'password_confirmation' => '12345677'
                ],
                true,
                [
                    'password' => ['パスワードと一致しません']
                ],
            ],
            'store' => [
                [
                    'name' => 'aaa',
                    'email' => 'aaaa@example.com',
                    'password' => '12345678',
                    'password_confirmation' => '12345678'
                ],
                false,
                [],
            ],

        ];
    }

    public function testUserRegister()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);

        $data = [
            'name' => 'aaa',
            'email' => 'aaaa@example.com',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ];
        $response = $this->postJson(route('store'), $data);

        $response->assertViewIs('verification_email');
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'name' => 'aaa',
            'email' => 'aaaa@example.com'
        ]);
    }
}