<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    //
    public function index()
    {

    }

    // Get All Users
    public function getUsers()
    {
      $users = User::paginate(10);

      return response()->json($users);
    }

    // Search For Users
    public function searchFunction($term = '')
    {
      $searched = User::where('name', 'LIKE', "%$term%")->orWhere('email', 'LIKE', "%$term%")->paginate(10);

      return response()->json($searched);
    }
}
