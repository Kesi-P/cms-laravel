@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-end mb-2">
  <a href="{{ route('posts.create') }}" class="btn btn-success"> Add Post</a> <!--can /categories/create but use the route is better check a route name by route:list-->
</div>
<div class="card card-default">
  <div class="card-header">
    Posts
  </div>
  <div class="card-body">
    @if($allpost->count() > 0)
    <table class="table">
      <thead>
        <th>Title</th>
        <th>Category</th>
        <th>Tag</th>
        <th>Image</th>
        <th></th>
        <th></th>
      </thead>
      <tbody>

          @foreach($allpost as $post)
          <tr>
          <td>
            {{$post->title}}
          </td>
          <td>
            <a href="{{ route('categories.edit' ,$post->category->id)}}">
            <!--if call function catedory() in Post.php you can do Query Builder-->
            {{$post->category()->where('id',$post->category_id)->value('name')}}
            </a>
            <!--can call name{{$post->category->name}}  directly cuz post belongsto -->
            <!-- {{$post->category->name}}  -->
          </td>
  
          <td>
            <img src="{{asset('storage/'.$post->image.'')}}" width="auto" height="60px" alt="">
          </td>
          @if($post->trashed())
          <td>
            <form action="/restore-post/{{$post->id}}" method="post">
              @csrf
              @method('PUT')
              <button type="submit" class="btn btn-success btn-sm">Restore</button>
            </form>
          </td>
          @else
          <td>
            <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info btn-sm">Edit</a>
          </td>
          @endif
          <td>
            <form action="{{route('posts.destroy',$post->id)}}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">
                {{ $post->trashed() ? 'Delete' : 'Trash'}}
              </button>
            </form>

          </td>
          </tr>
          @endforeach

      </tbody>
    </table>
    @else
    <h3 class="text-center"> No Posts Yet</h3>
    @endif
  </div>
</div>

@endsection
