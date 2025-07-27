# coachtech_flema

## アイテムの出品と購入ができるフリマアプリ

## 環境構築

### Dockerビルド

1. git clone git@github.com:hi-san10/coachtech_flema.git

2. docker-compose up -d --build

*MYSQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて docker-compose.yml ファイルを編集してください。

### Laravel環境構築

1. docker-compose exec php bash

2. composer install

3. env.example ファイルから .env を作成し、docker-compose.ymlに応じて環境変数を変更

    ・開発環境ではMailtrapサービスを使ってメール機能を開発しています

    ・Mailtrap url:[https://mailtrap.io](https://mailtrap.io)

    ・アカウント作成後、ログインする

    ・左メニューにある Email Testing リンク、もしくは画面中央あたりの Email Testing の「Start Testing」ボタンをクリック

    ・SMTP Settings タブをクリック

    ・Integrations セレクトボックスで、Laravel 7.x,8.x を選択

    ・copy ボタンをクリックして、クリップボードに .env の情報を保存

    ・.envにコピーした情報を貼り付ける
        ![75F1C55F-FC14-46BE-898D-9C25817259E9](https://github.com/user-attachments/assets/571e1894-4346-4b98-883d-af7e577a743e)


    ・stripeで決済機能をテストする場合

    ・stripe url:[https://stripe.com/jp](https://stripe.com/jp)

    ・ユーザー登録を済ませ、ダッシュボードへ

    ・画面右上の「テスト環境」にチェックを入れる

    ・テスト環境の「公開可能キー」と「シークレットキー」をそれぞれ .env に設定する
        ![Image](https://github.com/user-attachments/assets/b635f4c9-ae66-4868-937e-1e56ffcd278f)

    ・決済画面で使用するテスト用のカード番号 4242 4242 4242 4242

    ・有効期限は可能な範囲での数字 10/25->〇 13/22->×

    ・セキュリティーコードは適当な数字3つ

    ・php artisan config:clear で.env情報を更新


4. php artisan key:generate

5. php artisan migrate

6. php artisan storage:link

7. php artisan db:seed


・ 商品のダミーデータ10件分

・ 商品の状態(コンディション)のダミーデータ10件分

・ 商品のカテゴリーのダミーデータ14件分

・ 商品とカテゴリーを結びつけた中間テーブルのダミーデータ17件分

・ ユーザーのダミーデータ3件分↓

    name: user1
    email: user1@mail.com
    password: 11111111

    name: user2
    email: user2@mail.com
    password: 22222222

    name: user3
    email: user3@mail.com
    password: 33333333

・ ユーザーに結びつけてあるプロフィールデータ3件分

・ ユーザーに結びつけてある配送先住所等のデータ3件分

・ 10件分の商品のうちユーザーに結びつけて購入済みにしてあるデータ6件分

・ 購入済みの商品の取引データ6件分

・ 購入済みの商品の取引メッセージデータ6件分

## 使用技術

・PHP 8.3

・Laravel 8.83

・MYSQL 8.0

## ER図

![Image](https://github.com/user-attachments/assets/94eb9545-7af8-44cd-8eb1-af65e80f28a0)

## テーブル仕様書
![Image](https://github.com/user-attachments/assets/f4395c14-6650-43fd-a1a6-efe420b14921)

![Image](https://github.com/user-attachments/assets/4e09a092-369c-44ee-bf44-d4ed715b6259)

![Image](https://github.com/user-attachments/assets/d7d13156-b32d-4eb5-b7dc-93408c3256e7)

![Image](https://github.com/user-attachments/assets/bb529ba1-1b98-44c4-ae50-abc6bae9b15c)

![Image](https://github.com/user-attachments/assets/3178cf4f-0999-4b5e-b2d3-487d01755437)

![Image](https://github.com/user-attachments/assets/d9483be6-d20a-4c14-bb55-155a8221215e)

![Image](https://github.com/user-attachments/assets/54565012-805c-4d53-af6e-385afd1ef3b0)

## URL

・アプリケーション(開発環境):[http//localhost/](http//localhost/)

・phpMyAdmin:[http//localhost:8080](http/localhost:8080)
