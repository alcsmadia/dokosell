<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $fillable = ['amount', 'money', 'comment', 'date'];

    public function middle()
    {
        return $this
            ->belongsTo('App\Item_Shop');
    }
}
