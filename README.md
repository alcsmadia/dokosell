This is my practice for laravel.
I made a website that can show how much item's price and where I can be bought.

---

# 準備

SQL, PHPのtimezone

## インストール

### インストールが早くなる

$ composer config -g repositories.packagist composer packagist.jp
$ composer global require hirak/prestissimo

> URLとhttps, C:/Users/Hidenori/AppData/Roaming/Composer

### インストール

$ laravel new myapp

#### サーバー起動（必要？）

$ cd myapp
$ php artisan serve

# データベース作成

$ mysql -u root
create database mydb;

myapp/.env:
	DB_DATABASE=mydb
	DB_USERNAME=root
	# DB_PASSWORD=secret

## テーブル，MVCの作成

cd C:\xampp\htdocs\my_app
$ php artisan make:model All_table -m -c -r
$ php artisan make:model items -m
$ php artisan make:model shops -m
$ php artisan make:model branch -m

$ php artisan make:model money -m
$ php artisan make:model comment -m

$ php artisan make:migration create_item_shop_table

## モデル内(app/**.php )

- リレーションシップ

- 代入を許可する属性⇔guarded
  protected $fillable = ['name'];

## マイグレーション内(database/migrations/ )

- 列の追加

## config内

- 文字コードの設定(config/database.php)
  'charset' => 'utf8',
  'collation' => 'utf8_unicode_ci',

- timezone(config/app.php)

## テーブルの作成

$ php artisan migrate

○ルーティング設定
routes/web.php:

○コントローラ設定
app/Http/Controllers/TaskController.php:

○ビュー作成
resources/views/
