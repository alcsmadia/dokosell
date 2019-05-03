<?php

namespace App\Http\Controllers;

use App\Search_log;
use App\All_data; // モデルall_dataのクラスを"all_data"として扱えるように
use App\Item;
use App\Item_Shop;
use App\Shop;
use Illuminate\Http\Request; // HTTPリクエストインスタンスを取得

class myController extends Controller // Controllerクラスの承継
{
    public function index() // 一覧表示
    {
        return view('index'); // 移動
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        
        if ( $query ){
            $info = Item_Shop::with('item', 'shop', 'information')
                -> whereItem('items.name', 'like', '%' . addcslashes($query, '\_%') . '%')
                -> orderByLowestMoney()
                -> get();
            
            if ( $info ) {
                $count = $info->count();
            } else {
                $count = 0;
            }

            $log = new Search_log; // all_dataのオブジェクトを作成
            $log->query = $query; // itemプロパティに，Requestのnameパラメータを設定
            $log->counts = $count;
            $log->save();

            return view('result', ['query' => $query, 'count' => $count, 'items' => $info]);
        } else {
            return view('result', ['query' => $query, 'count' => 0, 'items' => array()]);
        }
    }

    public function add() // 一覧表示
    {
        $all_datas = All_data::orderBy('created_at', 'desc')
            ->take(10)->get(); // 10をデータベースから取得
        return view('add', ['all_datas' => $all_datas]); // 移動
    }

    public function store(Request $request) // ViewからのPOSTを$requestに
    {
        $request->validate([
            'item' => 'required|string|max:80',  // 必須・文字列・80文字以内
            'shop' => 'required|string|max:80',
        ]);

        // 送られてきたデータ
        $item_posted = $request->input('item');
        $shop_posted = $request->input('shop');
        $ten = array('支店','店');
        $branch_posted = str_replace($ten, "", $request->input('branch'));
        $amount_posted = $request->input('amount');
        $yen = array('円','\\','￥', '￥');
        $money_posted = str_replace($yen, "", $request->input('money'));
        $comment_posted = $request->input('comment');        
        $date_posted = $request->input('date');

        $all_data = new All_data; // all_dataのオブジェクトを作成
        $all_data->item = $item_posted; // itemプロパティに，Requestのnameパラメータを設定
        $all_data->shop = $shop_posted;
        $all_data->branch = $branch_posted;
        $all_data->amount = $amount_posted;
        $all_data->money = $money_posted;
        $all_data->comment = $comment_posted;
        $all_data->date = $date_posted;
        $all_data->save();

        $all_datas = All_data::orderBy('updated_at', 'desc')
        ->take(10)->get(); // 10をデータベースから取得

        // itemsの更新
        Item::updateOrCreate(['name'=> $item_posted]);
        $item_added = Item::where('name', $item_posted)->first();

        // shopsの更新
        Shop::updateOrCreate(['name'=> $shop_posted, 'branch'=> $branch_posted]);
        $branch_added = Shop::where('name', $shop_posted)->where('branch', $branch_posted)->first();

        // item_shop
        $item_added->middle()->updateOrcreate(
            ['item_id' => $item_added->id, 'shop_id' => $branch_added->id]
        );
        $middle_added = Item_Shop::where('item_id', $item_added->id)
            -> where('shop_id', $branch_added->id) -> first();

        // info
        $middle_added->information()->updateOrcreate(
            ['amount' => $amount_posted, 'money' => $money_posted, 'comment' => $comment_posted, 'date' => $date_posted]
        );

        return view('add', ['status' => True, 'all_datas' => $all_datas]); // リダイレクトして一覧表示
    }

    public function destroy($id, all_data $all_data)
    {
        $all_data = All_data::find($id); // タスクID($id)に対応するオブジェクトを取得
        $all_data->delete(); // 削除
        return redirect('all');
    }
}