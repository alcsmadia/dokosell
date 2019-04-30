@extends('layout')
<title>データの追加</title>
@section('breadcrumbs', Breadcrumbs::render('add'))

@section('content')
    <!---------------------------------------------------------------------------------------->
    <h1>データの追加</h1>
    @if ($errors->any())
        <div class="errors">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    @isset ($status)
        <div class="complete">
            <p>送信しました</p>
        </div>
    @endisset

    <form action="/add" method="POST" class="form-horizontal"><!-- 送信先URI -->
        {{ csrf_field() }}
        <!-- Task Name -->
        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" name="item" class="form-control" placeholder="商品" autocomplete="off">
                <input type="text" name="shop" class="form-control" placeholder="店名" autocomplete="off">
                <input type="text" name="comment" class="form-control" placeholder="コメント（※任意，例：家電コーナーの出口近くにありました）" autocomplete="off">
            </div>
        </div>

        <details>
        <summary>詳細情報を追加（任意）</summary>
        <input type="text" name="amount" class="form-control" placeholder="数量（※任意）" autocomplete="off">
        <input type="text" name="branch" class="form-control" placeholder="支店（※任意）" autocomplete="off">
        <input type="text" name="money" class="form-control" placeholder="金額（※任意）" autocomplete="off">
        <input type="date" name="date"
                           max=<?php echo date('Y-m-d'); ?>
                           min=<?php echo date('Y-m-d', strtotime("-2 year")); ?>
                           value=<?php echo date('Y-m-d'); ?>></input>
        </details>

        <!-- Add Task Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add
                </button>
            </div>
        </div>
    </form>

    追加されたデータ

    <div class="table-scroll">
    <table class="table table-striped task-table">
        <thead>
            <th>date</th>
            <th>item</th>
            <th>量や個数</th>
            <th>shop</th>
            <th>branch</th>
            <th>金額</th>
            <th>comment</th>
        </thead>

        <tbody>
            @foreach ($all_datas as $all_data)<!-- コントローラから送られたテーブルtasks -->
                <tr>
                    <!-- Task Name -->
                    <td>{{ $all_data->date }}</td>
                    <td>{{ $all_data->item }}</td>
                    <td>{{ $all_data->amount }}</td>
                    <td>{{ $all_data->shop }}</td>
                    <td>{{ $all_data->branch }}</td>
                    <td>{{ $all_data->money }}</td>
                    <td>{{ $all_data->comment }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection