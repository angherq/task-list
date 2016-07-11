@extends('layouts.app')

@section('content')
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <form action="{{url('user/'.$user->id.'/update')}}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

             <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Role</label>

                <div class="col-sm-6">
                    <select class="form-control" name="role">
                        @if($user->role == 'admin')
                            <option selected="selected">admin</option>
                            <option>regular</option>
                        @else 
                            <option>admin</option>
                            <option selected="selected">regular</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">First name</label>

                <div class="col-sm-6">
                    <input type="text" name="first_name" value="{{$user->first_name}}" class="form-control">   
                </div>
            </div>

             <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Last name</label>

                <div class="col-sm-6">
                    <input type="text" name="last_name" value="{{$user->last_name}}" class="form-control">   
                </div>
            </div>

             <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Password</label>

                <div class="col-sm-6">
                    <input type="password" name="password" placeholder="⚫⚫⚫⚫⚫⚫" class="form-control">   
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Update
                    </button>
                </div>
            </div>
        </form>
    </div>


@endsection