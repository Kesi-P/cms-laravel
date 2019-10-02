<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use App\Category;

class Post extends Model
{ use SoftDeletes;
  protected $fillable =['title','description','content','image','published_at','category_id'];

  /**
  *@return void
  */
  public function deleteImage()
  {
    Storage::delete($this->image);
  }

  public function category() //Category model name in small
  {
    return $this->belongsTo(Category::class); //one post in one category
  }

  public function Tags()
  {
    return $this->belongsToMany('App\Tag');
  }
}
