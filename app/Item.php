<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;

class Item extends Model
{
    protected $fillable = ['name', 'details']; // ホワイトリスト_複数代入時に代入を許可する属性⇔guarded
    
    public function middle()
    {
        return $this
            ->hasMany('App\Item_Shop');
    }
}
