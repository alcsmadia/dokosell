<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// トップ
Breadcrumbs::for('top', function ($trail) {
    $trail->push('トップ', url('/'));
});


// トップ > 検索結果
Breadcrumbs::for('search', function ($trail) {
    $trail->parent('top');
    $trail->push('検索結果', url('/search'));
});

// トップ > データの追加
Breadcrumbs::for('add', function ($trail) {
    $trail->parent('top');
    $trail->push('データの追加', url('/add'));
});