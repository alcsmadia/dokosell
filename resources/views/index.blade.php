@extends('layout')
<title>どこに売ってる？検索</title>

@section('content')
    <!---------------------------------------------------------------------------------------->
    <h1 class="top">どこに売ってる？</h1>

    <form action="./search" method="GET" class="form-horizontal">
        <!-- Query -->
        <div class="form-group">
            <label for="task" class="col-sm-3 control-label">検索商品を入力：</label>
            <div class="col-sm-6">
                <input type="text" name="q" class="form-control" autocomplete="off">
            </div>
        </div>

        <!-- Search Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Search
                </button>
            </div>
        </div>
    </form>

<p><span class="u"><a href="/add">商品の登録に協力してください！</a></span></p>
@endsection