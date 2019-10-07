<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;
use App\Tag;
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $category1 = Category::create([
        'name'=> 'naes'
      ]);
      $category2 = Category::create([
        'name'=> '2naes'
      ]);
      $tag1 = Tag::create([
        'name'=> 'Tag1'
      ]);
      $tag2 = Tag::create([
        'name'=> 'Tag2'
      ]);
        $post = Post::create([
          'title'=>'Kesi is cool title',
          'description'=>'Kesi is cool description',
          'content'=>'kesi is cool content',
          'category_id'=>$category1->id,
          'image'=>'posts/block-3.jpg'
        ]);
        $post2 = Post::create([
          'title'=>'2Kesi is cool title',
          'description'=>'2Kesi is cool description',
          'content'=>'2kesi is cool content',
          'category_id'=>$category2->id,
          'image'=>'posts/block-3.jpg'
        ]);

        $post2->Tags()->attach([$tag1->id,$tag2->id]);
    }
}
