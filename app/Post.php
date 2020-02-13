<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use App\Category;

class Post extends Model
{ use SoftDeletes;
  protected $fillable =['title','description','content','image','published_at','category_id','user_id'];

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
  /*chek if a post has tag*/
  public function hasTag($tagid)
  {
    return in_array($tagid,$this->tags->pluck('id')->toArray());
  }

  public function user()
  {
    return $this->belongsTo('App\User'::class);
  }

  public function scopeSearchsus($query)
  {
    $search = request()->query('search');
    if(!$search){
      return $query;
    }
    return $query->where('title','LIKE','%'.$search.'%');
  }
}
