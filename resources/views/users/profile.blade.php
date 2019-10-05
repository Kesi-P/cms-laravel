@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                  @include('partial.error')
                  <form class="" action="{{route('users.update-profile')}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" name="name" value="{{$users->name}}">
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="email" value="{{$users->email}}">
                    </div>
                    <div class="form-group">
                      <label for="about">About</label>
                      <textarea class="form-control" name="about" rows="3">{{$users->about}}</textarea>
                    </div>
                    <button type="submit" name="button">Update Profile</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
