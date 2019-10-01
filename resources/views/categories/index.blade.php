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
        <th>Posts Count</th>
        <th></th>
        <th></th>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td>
            {{ $category -> name}}
          </td>
          <td>
            {{ $category->post->count() }} <!--this cate point to post from category class and count-->
          </td>
          <td>
            <a href="{{ route('categories.edit',$category -> id) }}" class="btn btn-primary sm"> Edit</a>
          </td>

          <td>
            <a href="" class="btn btn-danger sm" onclick="handelDelete( {{$category -> id}} );return false">Delete</a>

          </td>
        </tr>
        @endforeach

      </tbody>
    </table>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="" method="POST" id="deleteForm">
        @csrf
        @method('DELETE')

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure to delete ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-danger">Yes</button> <!--submit to delete-->
          </div>
        </div>
      </form>


    </div>
  </div>

  </div>
</div>
@endsection
@section('scripts')
<script>
  function handelDelete(id){
    //console.log('id',id);
    var form = document.getElementById('deleteForm');
    form.action = '/categories/' + id;   <!--//categories/{category}-->
    $('#deleteModal').modal('show');
  }
</script>

@endsection
