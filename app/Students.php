<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Students extends Model
{
	
    protected $fillable = [
        'name', 'age', 'image','classroom_id'
    ];
	use SoftDeletes;

	public function classroom(){
       return $this->hasOne('App\classroom','id','classroom_id');
   }
}
