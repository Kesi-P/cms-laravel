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
    <table class="table">
      <thead>
        <th>Title</th>
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
            <img src="{{asset('storage/'.$post->image.'')}}" width="auto" height="60px" alt="">
          </td>
          <td>
            <a href="#" class="btn btn-info btn-sm">Edit</a>
          </td>
          <td>
            <form action="{{route('posts.destroy',$post->id)}}" method="post">
              @csrf
              @method('DELETE')
              @endmethod
              <button type="submit" class="btn btn-danger btn-sm">Trash</button>
            </form>

          </td>
          </tr>
          @endforeach

      </tbody>
    </table>
  </div>
</div>

@endsection
