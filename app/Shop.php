<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['name', 'branch'];
    
    public function middle()
    {
        return $this
            ->hasMany('App\Item_Shop');
    }
}