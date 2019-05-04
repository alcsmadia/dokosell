<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class All_data extends Model
{
    public function storeAll($item_posted, $shop_posted, $branch_posted, $amount_posted, $money_posted, $cospa, $comment_posted, $date_posted)
    {
        $this->item = $item_posted; // itemプロパティに，Requestのnameパラメータを設定
        $this->shop = $shop_posted;
        $this->branch = $branch_posted;
        $this->amount = $amount_posted;
        $this->money = $money_posted;
        $this->cospa = $cospa;
        $this->comment = $comment_posted;
        $this->date = $date_posted;
        $this->save();
    }
}
