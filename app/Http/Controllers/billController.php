<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Order;


class billController extends Controller
{

    public function addBill(Request $request)
    {

        $result = Bill::create([
            'amount' => $request->vnp_Amount / 23000 / 100,
            'type' => 'VNpay',
            'orderid' => $request->vnp_TxnRef,
            'accountno' => $request->vnp_TransactionNo
        ]);

        if ($result) {
            Order::find($request->vnp_TxnRef)->update(['checkout' => true]);
        }
        return $result;
    }
    public function index()
    {
        $data = Bill::all();

        return view('bill.index', ['bills' => $data]);
    }
    public function delete($billid)
    {
        $b = Bill::find($billid);
        $b->delete();
        return redirect('bill/index')->with(['success' => 'Deleted Successfully']);
    }
}
