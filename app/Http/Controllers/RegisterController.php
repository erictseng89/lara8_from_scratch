<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

    // We create the user here.
    $attributes = request()->validate([
      'name' => [
        'required',
        'max:255',
      ],
      'username' => [
        'required',
        'max:255',
        'min:3',
      ],
      'email' => [
        'required',
        'email',
        'max:255',
      ],
      'password' => [
        'required',
        'min:7',
        'max:255',
      ],
    ]);

    /**
     * create($attributes)
     * You can pass the $attributes variable which will pass the POST array into
     * the create method.
     */

    $attributes['password'] = bcrypt($attributes['password']);

    User::create($attributes);

    return redirect('/');

  }

}
