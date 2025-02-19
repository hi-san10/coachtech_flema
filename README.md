# coachtech_flema

## アイテムの出品と購入ができるフリマアプリ

## 機能一覧
・ 会員登録

・ 会員登録時にメールによる本人認証

・ ログイン

<!-- ・ 管理者ログイン -->

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

    ・php artisan config:clear　で.env情報を更新


4. php artisan key:generate

5. php artisan migrate

6. php artisan db:seed

・ 管理者と店舗代表者のメールアドレスとパスワードを画像からご確認ください


・ 管理者のダミーデータ↓

![103985DE-3AFC-41D1-B28B-B189BDC8938A](https://github.com/user-attachments/assets/cf370312-651d-4836-94b7-b7154552033a)

・ 店舗代表者のダミーデータ↓
    ![FD5EA0FD-041B-4AEF-B432-22E28D01A9C7](https://github.com/user-attachments/assets/ad3966fc-6179-4ad1-84c8-c06de3f32963)
    ![04B1E917-C4CF-48AF-910B-4D830017AE1E](https://github.com/user-attachments/assets/761d5d2d-7075-4a9a-82fc-d6607e250670)
    ![05112EF6-A728-4446-BB89-E15254AA7D07](https://github.com/user-attachments/assets/ea45b5fe-2d70-4aaa-be4f-b36a69fef9be)
    ![A93B5A1B-B63E-4FC8-A7BC-F8BCA12CEA87](https://github.com/user-attachments/assets/a66365ee-31e6-4599-98cd-2de535aacd1a)
    ![FED2A9A7-3812-4C43-AB98-95DBED98E53A](https://github.com/user-attachments/assets/b1af28ea-7392-46c2-b236-10264c396df3)

・ 店舗のダミーデータ20件分

・ エリア(都道府県)のデータ47件分

・ ジャンルのデータ5件分


## 使用技術

・PHP 8.3

・Laravel 8.83

・MYSQL 8.0

## ER図

![68665E27-D515-47E8-A490-7EC4B65D6E67](https://github.com/user-attachments/assets/f58ca598-9b35-4f09-bc88-8b3a363d5455)

## テーブル仕様書

![368CB9FA-147A-4D91-9D24-022E0649C094](https://github.com/user-attachments/assets/bfc9375e-4bab-43df-a9db-433b8130d6ba)
![917D21F8-6803-4C15-94C4-702D24E7793C](https://github.com/user-attachments/assets/2a361865-e6ef-4c53-bcea-a9df2842c3bf)
![7592347D-D03A-4ED0-B3B2-FFC6243FB860](https://github.com/user-attachments/assets/756497af-bf88-4ed8-8d6a-e60fa67a0910)
![20FC4574-AE0E-498E-A402-CEBD096EB953](https://github.com/user-attachments/assets/3d7d7014-563d-4b14-9512-4fea07add639)

## URL

・アプリケーション(開発環境):[http//localhost/](http//localhost/)

・phpMyAdmin:[http//localhost:8080](http/localhost:8080)
