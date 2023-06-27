<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\view;

class viewController extends Controller
{
     public function create(Request $request)
     {
          $userID = $request->userID;
          $dishID = $request->dishID;
          $action = new view();

          $result = $action->addView($userID, $dishID);
          return $result;
     }
}
