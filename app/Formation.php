<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
     public function article(){
    	return $this->belongsTo("App\Article");
    }
}
