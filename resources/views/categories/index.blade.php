@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
  <a href="{{ route('categories.create') }}" class="btn btn-success"> Add Category</a> <!--can /categories/create but use the route is better check a route name by route:list-->
</div>
<div class="card card-default">
  <div class="card-header">
    Categories
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <th>Name</th>
        <th></th>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td>
            {{ $category -> name}}
          </td>
        </tr>
        <tr>
          <td>
            <a href="{{ route('categories.edit',$category -> id) }}" class="btn btn-primary sm"> Edit</a> 
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
</div>
@endsection
