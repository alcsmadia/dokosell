<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;

class Item_Shop extends Pivot
{
    protected $table = 'item_shop';
    protected $fillable = ['item_id', 'shop_id'];

    public function scopeOrderByLowestMoney(Builder $query): Builder
    {
        return $query
            ->join('information', 'item_shop.id', '=', 'information.item_shop_id')
            ->leftJoin('information as filter', function (JoinClause $join) {
                $join->on('information.item_shop_id', '=', 'filter.item_shop_id');
                $join->on(function (JoinClause $join) {
                    $join->on('information.id', '>', 'filter.id');
                    $join->on('information.money', '=', 'filter.money');
                    $join->Oron('information.money', '>', 'filter.money');
                });
            })
            ->whereNull('filter.id')
            ->select('item_shop.*')
            ->orderBy('information.money')
            ->orderBy('information.id');
    }

    public function scopeWhereItem(Builder $query, ...$args): Builder
    {
        return $query
            ->join('items', 'item_shop.item_id', '=', 'items.id')
            ->where(function (Builder $query) use ($args) {
                $query->setModel(new Item())->where(...$args);
            });
    }

    public function item()
    {
        return $this -> belongsTo('App\Item');
    }

    public function shop()
    {
        return $this -> belongsTo('App\Shop');
    }

    public function information()
    {
        return $this -> hasMany('App\Information', 'item_shop_id');
    }
}
