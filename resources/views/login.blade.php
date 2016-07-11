
@extends('layouts.app')

@section('content')



<div class="container">
  <h2>Login to Scopic task manager</h2>
  <form method="POST" action="{{url('auth/login')}}">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" id="password" value="{{ old('email') }}" class="form-control">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" name="password" id="password" class="form-control">
    </div>
    <div class="checkbox">
      <label><input type="checkbox"> Remember me</label>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>


@endsection