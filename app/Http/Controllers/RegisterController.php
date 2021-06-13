<?php

namespace App\Http\Controllers;

use App\Models\User;

class RegisterController extends Controller
{

  public function create()
  {
    return view('register.create');
  }

  public function store()
  {

    /**
     * validate()
     * Laravel will validate the post variables. If successful, then the POST
     * request will be processed, otherwise laravel return the previous page.
     */
    $attributes = request()->validate([
      'name' => [
        'required',
        'max:255',
      ],
      'username' => [
        'required',
        'max:255',
        'min:3',
        'unique:users,username',
      ],
      'email' => [
        'required',
        'email',
        'max:255',
        'unique:users,username',
      ],
      'password' => [
        'required',
        'min:7',
        'max:255',
      ],
    ]);

    /**
     * bcrypt()
     *
     * We must pass through the user's password through the bcrypt function to
     * hash it.
     */
    $attributes['password'] = bcrypt($attributes['password']);

    /**
     * create($attributes)
     *
     * You can pass the $attributes variable which will pass the POST array into
     * the create method.
     */
    $user = User::create($attributes);

    /**
     * Registration successful message
     *
     * We can create a quick message to inform user registration was successful.
     * session()->flash()
     * The session flash method saves a key/value that will only be stored for 1
     * request.
     *
     * This statement can be shorthanded using the redirect()->with() method.
     *
     * session()->flash("success", "Your registration was successful!");
     */

    /**
     * User login
     *
     * Once a user has been created, we can create a session for them and sign
     * them in immediately. We call the auth() function which extends the
     * Auth::class that contains session related methods.
     */
    auth()->login($user);

    return redirect('/')->with("success", "Your registration was successful!");

  }

}
