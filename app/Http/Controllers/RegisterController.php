<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
   /**
 * The user has been registered.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  mixed  $user
 * @return mixed
 */
protected function registered(Request $request, $user)
{
    auth()->logout();   // immediately log out the new user

    return redirect('/login')->with('status', 'Registration successful! Please log in with your credentials.');
}
}
