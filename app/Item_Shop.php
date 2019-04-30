<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_Shop extends Model
{
    protected $table = 'item_shop';
    protected $fillable = ['item_id', 'shop_id'];

    public function item()
    {
        return $this
            ->belongsTo('App\Item');
    }

    public function shop()
    {
        return $this
            ->belongsTo('App\Shop');
    }

    public function information()
    {
        return $this
            ->hasMany('App\Information', 'item_shop_id');
    }
}
