@extends('layout')
<title>どこに売ってる？「{{$query}}」の検索結果</title>
@section('breadcrumbs', Breadcrumbs::render('search'))
@section('content')
    <h1 class="middle-font">検索結果</h1>
    <form action="/search" method="GET" class="form-horizontal">
        <!-- Query -->
        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" name="q" class="form-control" value="{{$query}}">
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

    「{{$query}}」の検索結果：{{$count}} 件

    <table class="table table-striped task-table">
        <thead>
            <th>商品名</th><th>店</th><th>支店</th><th>量</th><th>金額・コメント</th>
        </thead>

        <tbody>
            @foreach ((object)$items as $item)<!-- nullのときのためにobjuctに変換 -->
                <tr>
                    <td>{{$item->item->name}}</td>
                    <td>{{$item->shop->name}}</td>
                    <td>
                    <?php
                        if ($item->shop->branch) {
                            echo $item->shop->branch."店 "."(<span class='u'><a href='https://www.google.co.jp/maps/search/".$item->shop->name."+".$item->shop->branch."' target='_blank'>map</a></span>)";
                        } else {
                            echo "未登録";
                        }
                    ?>
                    </td>
                    <td>
                        @foreach ($item->information->sortBy('money') as $info)
                            <?php
                            if ($info->amount) {
                                echo $info->amount;
                            }
                            ?></span><br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($item->information->sortBy('money') as $info)
                            <span class="gray">・{{$info->date}}</span>
                            <?php
                            if ($info->money) {
                                echo "<br>".$info->money." 円";
                            }
                            if ($info->comment) {
                                echo "<br>".$info->comment;
                            }
                            ?></span><br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
<p><span class="u"><a href="/add">商品の登録に協力してください！</a></span></p>
@endsection