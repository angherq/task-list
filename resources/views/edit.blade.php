@extends('layouts.app')

@section('content')
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <form action="{{url('task/'.$task->id.'/update')}}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

             <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Assigened to</label>

                <div class="col-sm-6">
                    <select class="form-control" name="user_id">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->first_name}}</option>
                        @endforeach
                    </select>  
                </div>
            </div>

            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" value="{{$task->name}}" class="form-control">   
                </div>
            </div>

             <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Description</label>

                <div class="col-sm-6">
                    <input type="text" name="description" value="{{$task->description}}" class="form-control">   
                </div>
            </div>

             <div class="form-group">
                <label for="task" class="col-sm-3 control-label">State</label>

                <div class="col-sm-6">
                    <select class="form-control" name="state">
                        @if($task->state == 'new')
                            <option selected="selected">new</option>
                            <option>in-progress</option>
                            <option>finished</option>
                        @elseif($task->state == 'in-progress')
                            <option>new</option>
                            <option selected="selected">in-progress</option>
                            <option>finished</option>
                        @else 
                            <option>new</option>
                            <option>in-progress</option>
                            <option selected="selected">finished</option>
                        @endif
                    </select>    
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