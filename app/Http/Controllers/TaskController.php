<?php
namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use App\Models\Task;
use App\Models\User;

use Illuminate\Http\Request;
use Validator;
use Auth;


class TaskController extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, ValidatesRequests;

    public function read() {

    	if(!Auth::user())
    		return redirect('/auth/login');

    	if(Auth::user()->role == 'admin') {
    		$tasks = Task::all();
    		$users = User::all();
    	}

    	else {
    		$tasks = Task::where('user_id', Auth::user()->id)->get();
    		$users = User::where('id', Auth::user()->id)->get();
    	}

    	foreach($tasks as $task) {
    		$task->responsible = User::find($task->user_id)->first_name;
    	}

    	return view('tasks', ['tasks' => $tasks, 'users' => $users]);
    }

    public function create(Request $request) {
    	$validator = Validator::make($request->all(), [
        	'name' => 'required|max:255',
        	'assign_to' => 'numeric|max:' . User::orderBy('id', 'desc')->first()->id
	    ]);

	    if ($validator->fails()) {
	        return redirect('/')
	            ->withInput()
	            ->withErrors($validator);
	    }

	    $task = new Task();
	    $task->user_id = $request->assign_to;
		$task->name = $request->name;
		$task->description = $request->description;
		$task->state = 'new';
		$task->save();

	    return redirect('/');
    }

    public function state($task_id) {

    	$task = Task::find($task_id);
    	if($task->state == 'new')
    		$new_state = 'in-progress';
    	else if($task->state == 'in-progress')
    		$new_state = 'finished';
    	else 
    		$new_state = 'new';

    	$task->state = $new_state;
    	$task->save();

    	return response()->json(['status' => 'success']);
    }

    public function edit($task_id) {

    	if(Auth::user()->role == 'admin')
    		$users = User::all();
    	else
    		$users = User::where('id', Auth::user()->id)->get();

    	$task = Task::find($task_id);

    	return view('edit', ['task' => $task, 'users' => $users]);
    }

    public function update(Request $request, $task_id) {

        $task = Task::find($task_id);

        $task->user_id = $request->user_id;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->state = $request->state;

        $task->save();

        return redirect('/');
    }

    public function delete($task_id) {

    	$task = Task::find($task_id);
    	$task->delete();

    	return response()->json(['status' => 'success']);
    }

}
