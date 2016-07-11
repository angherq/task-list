<?php
namespace App\Http\Controllers;

use App\Models\User;

use Hash;
use Auth;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;

class AuthController extends Controller {

	public function getLogin() {
		return view('login');
	}

    public function postLogin(Request $request) {
        if (Auth::attempt(['confirmed' => 1, 'email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
            return redirect()->intended('/');
        }
        //Auth failed
        return back()->withInput();
    }

    public function Logout() {

    	Auth::logout();
    	
    	return redirect()->intended('/auth/login');
    }

    public function getRegister() {

        return view('register');
    }

    public function postRegister(Request $request) {

        $user = new User();

        $user->confirmed = 0;
        $user->email = $request->email;
        $user->role = 'regular';
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->password = Hash::make($request->password);

        $user->save();

        $headers =  'MIME-Version: 1.0' . "\r\n"; 
        $headers .= 'From: Your name <scopic@scopic.com>' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

        ini_set("SMTP","ssl://smtp.gmail.com");
        ini_set("smtp_port","465");

        mail($user->email, 'Confirm your email address', 'Please use this link for confirm your email address: http://localhost/scopic/public/auth/confirm/' . $user->id, $headers);

        return redirect('auth/confirmation');
    }

    public function getConfirmation() {

        return view('confirmation');
    }

    public function getConfirm($user_id) {

        $user = new User();
        $user->confirmed = 1;
        $user->save();

        Auth::login($user);

        return redirect()->intended('/');
    }
}