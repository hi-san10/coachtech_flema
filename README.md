# coachtech_flema

## アイテムの出品と購入ができるフリマアプリ

## 機能一覧
・ 会員登録

・ 会員登録時にメールによる本人認証

・ ログイン

・ ログアウト

・ 商品一覧取得

・ 商品詳細情報取得

・ 商品を名前(部分一致)で検索

・ 商品購入

・ 商品出品

・ 商品をお気に入り(いいね)できる

・ 商品にコメントできる(ログインユーザーのみ)

・ ユーザー別のマイページ(自身が購入、出品した商品一覧)

・ ログインユーザーのいいねした商品一覧取得(マイリスト)

・ 初回ログイン後プロフィール設定

・ プロフィール情報変更

・ 商品購入時、配送先住所追加

## 環境構築

### Dockerビルド

1. git clone git@github.com:hi-san10/coachtech_flema.git

2. docker-compose up -d --build

*MYSQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて docker-compose.yml ファイルを編集してください。

### Laravel環境構築

1. docker-compose exec php bash

2. composer install

3. env.example ファイルから .env を作成し、環境変数を変更

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

6. php artisan db:seed


・ 商品のダミーデータ10件分

・ 商品の状態(コンディション)のダミーデータ10件分

・ 商品のカテゴリーのダミーデータ14件分

・ 商品とカテゴリーを結びつけた中間テーブルのダミーデータ17件分

・ ユーザーのダミーデータ1件分↓
![Image](https://github.com/user-attachments/assets/fef256f3-d5c0-446a-8505-87e1527a9970)

## 使用技術

・PHP 8.3

・Laravel 8.83

・MYSQL 8.0

## ER図

![Image](https://github.com/user-attachments/assets/cf635c52-c126-42c2-a8cc-f72b315c29b3)

## テーブル仕様書
![Image](https://github.com/user-attachments/assets/f4395c14-6650-43fd-a1a6-efe420b14921)

![Image](https://github.com/user-attachments/assets/4e09a092-369c-44ee-bf44-d4ed715b6259)

![Image](https://github.com/user-attachments/assets/d7d13156-b32d-4eb5-b7dc-93408c3256e7)

![Image](https://github.com/user-attachments/assets/bb529ba1-1b98-44c4-ae50-abc6bae9b15c)

![Image](https://github.com/user-attachments/assets/3178cf4f-0999-4b5e-b2d3-487d01755437)

## URL

・アプリケーション(開発環境):[http//localhost/](http//localhost/)

・phpMyAdmin:[http//localhost:8080](http/localhost:8080)
