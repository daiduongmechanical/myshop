<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Bill;

class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = $request->sort;
        $day = $request->day;
        $search = $request->search;
        $action = new Order();

        $result = $action->getAllOrder($sort, $day, $search);
        return $result;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = new Order();
        $result = $action->getNumberOrders();

        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $action = new Order();
        $result = $action->addOrder($request->all());
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $action = new Order();
        $all = $request->all;
        if ($id / 200000 < 1) {
            $result =  $action->getOrderByuserID($id, $all);
        } else {
            $result =  $action->getOrderbyOrderID($id);
        }

        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $action = new Order();
        $status = $request->type;
        $result = $action->updateStatus($id, $status);

        if ($result) {
            $check = Order::find($id);
            if ($check->status === 'finished') {
                //create bill 
                $handleBill = new Bill();
                $handleBill->cashPayment($id);
                //update checkout
                $check->checkout = true;
                $check->save();
            }
        }
        return $result;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
