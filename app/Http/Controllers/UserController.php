<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Album;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function login_page()
    {
        return view('authentication.login');

    }
    public function register_page()
    {
        return view('authentication.register');

    }
    public function home()
    {
        try {
            $albums = Album::orderBy('id', 'desc')->get();

            return view('albums.index', ['albums' => $albums]);

        } catch (Exception $ex) {
            return redirect()->route('users.login_page')->with(['error' => ' حدث خطأ  ما']);

        }
    }

    public function register_post(StoreUserRequest $request)
    {

        $user = new User();
        $user->username = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // the best place on model

        $user->save();
        // save the new user data
        if ($user->save()) {
            return redirect()->route('albums.index')->with(['success' => 'تم الحفظ بنجاح']);
        } else {
            return redirect()->route('users.login_page')->with(['error' => 'حدث خطا ما']);
        }

    }
    public function login_post(LoginUserRequest $request)
    {

        try {

            if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
                return redirect()->route('albums.index');

            } else {
                return redirect()->route('users.login_page')
                    ->with('error', 'Email-Address or Password Are Wrong.');
            }

        } catch (Exception $ex) {
            return redirect()->route('users.login_page')->with(['error' => ' حدث خطأ  ما']);

        }

    }
    public function logout()
    {

        Session::flush();

        Auth::logout();

        return redirect()->route('users.login_page');
    }
}
