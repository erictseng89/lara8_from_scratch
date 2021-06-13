<?php

namespace App\Http\Controllers;

use Auth;
use Dotenv\Exception\ValidationException;
use Redirect;

class SessionsController extends Controller
{

  public function create()
  {
    return view('sessions.create');
  }

  public function store()
  {

    /**
     * We will first need to validate that the user input is corrent. The
     * "exists: table, column" validation checks the column does contain the
     * user's email.
     */
    $authenticate = request()->validate([
      "email" => [
        "required",
        "max:255",
        "exists:users,email",
      ],
      "password" => [
        "required",
        "min:7",
        "max:255",
      ],
    ]);

    /**
     * auth()->attempt()
     *
     * This method would attempt to login. This method would validate the user
     * inputs, then creating session if successful. We need to create the login
     * session based on the provided credentials.
     *
     * auth()->regenerate()
     * This method is to prevent "session fixation" attack. The attacker will
     * trick the user into logging in with a known session ID. The attacker then
     * will be able to gain access by using the session ID. The regenerate()
     * method will provide the user with a new session ID once they sign in.
     *
     */
    if (auth()->attempt($authenticate))
    {
      auth()->regenerate();

      // Redirect user back to home page with a flash message.
      return \redirect('/')->with('success', 'Welcome Back!');
    }

    /**
     * Should the attempt fail, then we need to return error messages.
     *
     * back()->withErrors(); The withErrors() method takes an associative array.
     * The key will be the input name, and the value will be the message that is
     * returned for the user.
     *
     * withInputs() is a method that will flash the old input as an array. It be
     * then be shown as the values for the inputs.
     *
     * This is an example of a return error message.
     * return back()
     * ->withInput()
     * ->withErrors(['email' => 'Your provided credentials cannot be authenticated']);
     *
     * Another example of a return error message is using:
     * throw ValidatinException::withMessages
     */
    throw ValidationException::withMessages([
      'email' => 'Your provided credentials cannot be authenticated',
    ]);

  }

  public function destroy()
  {
    auth()->logout();

    return redirect('/')->with('success', 'Goodbye!');
  }

}
