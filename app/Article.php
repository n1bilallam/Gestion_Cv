<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use SoftDeletes;
    protected $dates =['deleted_at'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function experiences(){
    	return $this->hasMany('App\Experience');
    }
    public function formations(){
    	return $this->hasMany('App\Formation');
    }
     public function competences(){
    	return $this->hasMany('App\Competence');
    }
     public function projets(){
    	return $this->hasMany('App\Projet');
    }
}
