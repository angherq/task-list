<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;

use Auth;
use Hash;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {

	public function edit($user_id) {

        $user = User::find($user_id);

		return view('users.edit', ['user' => $user]);
	}

    public function update(Request $request, $user_id) {
        
        $user = User::find($user_id);

        $user->role = $request->role;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        if(strlen($request->password))
            $user->password = Hash::make($request->password);

        $user->save();

        return redirect('/');
    }

    public function exportcsv() {

        if(Auth::user()->role == 'admin')
            $tasks = Task::all();
        else
            $tasks = Task::where('user_id', Auth::user()->id)->get();

        
        $fp = fopen('file.csv', 'w');

        foreach ($tasks as $task) {
            fputcsv($fp, $task->toArray());
        }

        fclose($fp);        

        return response()->download(public_path() . '/' . 'file.csv', 'file.csv', ['content-type' => 'csv'])->deleteFileAfterSend(true);
    }

    public function exportxml() {

        if(Auth::user()->role == 'admin')
            $tasks = Task::all();
        else
            $tasks = Task::where('user_id', Auth::user()->id)->get();

        
        $xml = new \SimpleXMLElement('<xml/>');

        foreach($tasks as $task) {
            $track = $xml->addChild('task');
            $track->addChild('name', $task->name);
            $track->addChild('description', $task->description);
            $track->addChild('state', $task->state);
            $track->addChild('created_at', $task->created_at);
            $track->addChild('updated_at', $task->updated_at);
        }

        header('Content-type: text/xml');
        header('Content-Disposition: attachment; filename="tasks.xml"');
        echo ($xml->asXML());
    }

    public function delete($user_id) {

        $user = User::find($user_id);
        $user->delete();

        return response()->json(['status' => 'success']);

    }

}