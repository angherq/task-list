
@extends('layouts.app')

@section('content')



<div class="container">
  <h2>Register</h2>
  <form method="POST" action="{{url('auth/register')}}">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="pwd">First Name:</label>
      <input type="text" name="first_name" class="form-control">
    </div>
      <div class="form-group">
      <label for="pwd">Last Name:</label>
      <input type="text" name="last_name" class="form-control">
    </div>
      <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>


@endsection