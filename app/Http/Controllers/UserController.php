<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Rate;
use Illuminate\Support\Facades\DB;
use App\Models\view;
use App\Models\Dishe;
use Session;

class UserController extends Controller
{
    public function index()
    {
        $data = new User();
        $user = $data::all();
        session()->forget('status');
        return view('.user.index', ['user' => $user]);
    }

    public function view($id)
    {
        $order = Order::where('userid', $id)->get();
        $sum = 0;
        foreach ($order as $item) {
            $sum += $item->totalcost;
        }


        $recieve = View::selectRaw('dishid,count(*) as total')

            ->where('userid', $id)
            ->groupBy('dishid')->orderBy('total', 'desc')
            ->get();
        if (count($recieve) === 0) {
            $view = "";
        } else {
            $view = Dishe::find($recieve[0]->dishid);
        }

        $rate = Rate::where('userid', $id)->get();
        $user = User::find($id);

        return view('user.view', compact('user', 'order', 'sum', 'rate', 'view'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('user.update', compact('user'));
    }

    public function postEdit(Request $request)
    {
        $id = $request->id;
        $manage = $request->manage;
        $user = User::find($id);
        $user->id;
        $user->manage = $manage;
        $user->save();
        session()->put('status', 'Edit Successfully');
        return redirect('user/edit/' . $id);
    }

    public function delete($id)
    {
        $s = User::find($id);
        $s->block = true;
        $s->save();
        Session()->put('deleted', 'Block user successfully');
        return \back();
    }

    public function searchAjax(Request $request)
    {
        $keyword = $request->keyword;
        $user = [];
        if ($keyword === "") {
            $user = User::all();
        } else {
            $user = User::where('email', 'like', '%' . $keyword . '%')->get();
        }
        return response()->json([
            'users' => $user
        ]);
    }

    public function restore($id)
    {
        $action = User::find($id);
        $action->block = false;
        $action->save();

        Session()->put('deleted', 'Restore user successfully');
        return \back();
    }
}
