<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class classroom extends Model
{
    protected $fillable = [
        'table', 'computers', 'title',
    ];

    public function students(){
       return $this->hasMany('App\Students','classroom_id','id');
   }
}
