@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endsection
@section('content')

<div class="card card-default">
  <div class="card-header">
    {{ isset($editpost) ? 'Edit Post' :'Create Post' }}
  </div>
  <div class="card-body">
    <form  action="{{ isset($editpost) ? route('posts.update',$editpost->id) : route('posts.store') }}" method="post" enctype="multipart/form-data"> <!--or else the file can't be uploaded-->
      @csrf
      @if(isset($editpost))
      @method('PUT')
      @endif
    <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ isset($editpost) ? $editpost->title :'' }}">
    </div>

    <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3" >{{ isset($editpost) ? $editpost->description :'' }}</textarea>
    </div>

    <div class="form-group">
    <label for="content">Content</label>
    <input id="content" type="hidden" name="content" value="{{ isset($editpost) ? $editpost->content :'' }}">
    <trix-editor input="content"></trix-editor>
    </div>

    <div class="form-group">
    <label for="published_at">Published At</label>
    <input type="text" class="form-control" id="published_at" name="published_at" value="{{ isset($editpost) ? $editpost->published_at :'' }}">
    </div>
    @if(isset($editpost))
    <div class="form-group">
      <img src="{{asset('storage/'.$editpost->image.'')}}" width="auto" height="250px" alt="">
    </div>
    @endif
    <div class="form-group">
    <label for="image">Image</label>
    <input type="file" class="form-control" id="image" name="image" value="{{ isset($editpost) ? $editpost->image :'' }}">
    </div>
    <button type="submit" class="btn btn-primary mb-2">
      {{ isset($editpost) ? 'Update Post' :'Create Post' }}</button>
    </form>
  </div>
</div>

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript">
  flatpickr("#published_at",{
    enableTime: true,
  });
</script>
@endsection
