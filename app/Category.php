<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $fillable =['name'];  //permit to sign a nam to db

    public function post()
    {
      return $this->hasMany('App\Post');
    }
}
