@extends('layouts.app')

@section('content')

<div class="card card-default">
  <div class="card-header">
    {{ isset($categoryid) ? 'Edit Category' : ' Create Category'}}
  </div>
  <div class="card-body">
    @if($errors->any())
    <div class="alert alert-danger">
      <ul class="list-group">
        @foreach($errors->all() as $error)
        <li class="list-group-item text-danger">
          {{$error}}
        </li>
        @endforeach
      </ul>
    </div>
    @endif
    <form action="{{ isset($categoryid) ? route('categories.update',$categoryid->id) : route('categories.store') }}" method="POST">
      @csrf
      @if(isset($categoryid))
      @method('PUT') <!--As form can have put or get but for update we need to put , this is how to tell laravel-->
      @endif
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ isset($categoryid) ? $categoryid->name : '' }}">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success">{{ isset($categoryid) ? 'Save Category' : ' Add Category'}}</button>
      </div>

    </form>
  </div>
</div>
@endsection
