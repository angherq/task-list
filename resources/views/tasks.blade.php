@extends('layouts.app')

@section('content')
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Task Form -->
        <form action="{{ url('new') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Assign to</label>

                <div class="col-sm-6">
                    <select class="form-control" name="assign_to">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->first_name}}</option>
                        @endforeach
                    </select>  
                </div>
            </div>

            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Task Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Task Description</label>

                <div class="col-sm-6">
                    <textarea name="description" id="task-description" class="form-control" placeholder="Optional"></textarea>
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Task
                    </button>
                </div>
            </div>
        </form>
    </div>


    <!-- Current Tasks -->
    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="col-md-9">
                    <span>Current Tasks</span>
                </div>
                
                <a href="./user/export/csv">
                    <button type="submit" class="btn btn-success export-csv">
                        <i class="fa fa-plus"></i> Export to CSV
                    </button>
                </a>

                <a href="./user/export/xml">
                    <button type="submit" class="btn btn-success export-xml">
                        <i class="fa fa-plus"></i> Export to XML
                    </button>
                </a>
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Task name</th>
                        <th>Assigned to</th>
                        <th>State</th>
                        <th>Action</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    {{ $task->name }} 
                                    <span style="color:gray;"> {{strlen($task->description)? '-': ''}} {{$task->description}} <span> 
                                </td>

                                <td class="table-text">
                                    <span>{{$task->responsible}}</span>
                                </td>

                                <td>
                                    <button id="{{$task->id}}" type="button" class="btn btn-link change-state">{{$task->state}}</button>
                                </td>

                                 <td>
                                    <a href="{{url('task/'.$task->id.'/edit')}}"><button type="button" class="btn btn-info">Edit</button></a>
                                    <button id="{{$task->id}}" type="button" class="btn btn-danger delete-task">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if (count($users) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Users
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="table-text">
                                    <span> {{ $user->first_name }} </span>
                                </td>

                                <td class="table-text">
                                    <span> {{$user->role}} </span>
                                </td>

                                <td>
                                    <span> {{$user->email}} </span>
                                </td>

                                 <td>
                                    <a href="{{url('user/'.$user->id.'/edit')}}"><button type="button" class="btn btn-info">Edit</button></a>
                                    @if(Auth::user()->role == 'admin' &&  Auth::user()->id !== $user->id )
                                        <button id="{{$user->id}}" type="button" class="btn btn-danger delete-user">Delete</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection