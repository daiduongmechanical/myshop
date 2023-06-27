<?php

namespace App\Http\Controllers;

use App\Models\Dishe;
use App\Models\Dishimage;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\view;



class OverviewController extends Controller
{


    public function handleToken($id)
    {
        Session()->put('auth', $id);
        return redirect('/');
    }

    public function total(Request $request)
    {
        $action = new Order();
        $viewAction = new View();

        if (isset($request->month)) {
            $time = $request->month;
            $year = explode('-', $time)[0];
            $month = explode('-', $time)[1];

            $order = $action->totalOrderByMonth($month, $year);
            $cost = $action->totalCostByMonth($month, $year);
            $view =  $viewAction->totalViewByMonth($month, $year);



            $result = [
                'order' => $order,
                'cost' => $cost,
                'view' => $view
            ];
        }
        return $result;
    }

    public function detail()
    {
        $today = date("Y/m/d");
        $month = date("m", strtotime($today));
        $date = date("d", strtotime($today));
        $year = date("Y", strtotime($today));
        $action = new Order();
        $totalView = $action->overview_ViewByDate($month, $date, $year);
        $totalOrder = $action->overview_OrderByDate($month, $date, $year);
        $totalCost = $action->overview_CostByDate($month, $date, $year);


        $data = Order::selectRaw('dishid, SUM(totalcost) as sum')
            ->join('orderdishes', 'orders.orderid', '=', 'orderdishes.orderid')
            ->whereDay('orders.created_at', '=', $date)
            ->whereMonth('orders.created_at', '=', $month)
            ->whereYear('orders.created_at', '=', $year)
            ->groupBy('dishid')
            ->take(4)
            ->get();
        foreach ($data as $d) {
            $d['info'] = Dishe::find($d['dishid'])->load('dishimages')->load('orderdish');
        }

        $result = [$totalCost, $totalView,  $totalOrder, $data];
        return view('overview.overview', ['overviews' => $result]);
    }

    public function sortBy(Request $request)
    {
        $value = $request->value;
        $type = $request->type;
        $orderBy = $request->orderBy;

        if ($type === "month") {
            $month = date("m", strtotime($value));
            $year = date("Y", strtotime($value));
            $action = new Order();
            $totalView = $action->overview_ViewByMonth($month, $year);
            $totalOrder = $action->overview_OrderByMonth($month, $year);
            $totalCost = $action->overview_CostByMonth($month, $year);
            $result = [$totalCost, $totalView,  $totalOrder];

            $data = Order::selectRaw('dishes.dishid, COUNT(orders.orderid) as totalorder, SUM(orderdishes.quantity * dishes.dishprice) as totalcost')
                ->join('orderdishes', 'orders.orderid', '=', 'orderdishes.orderid')
                ->join('dishes', 'orderdishes.dishid', '=', 'dishes.dishid')
                ->whereMonth('orders.created_at', '=', $month)
                ->whereYear('orders.created_at', '=', $year)
                ->groupBy('dishes.dishid')
                ->orderByDesc($orderBy)
                ->take(4)
                ->get();
            foreach ($data as $d) {
                $d['info'] = Dishe::find($d['dishid'])->load('dishimages')->load('orderdish');
            }
            return [$result, $data];
        } else if ($type === "date") {
            $month = date("m", strtotime($value));
            $date = date("d", strtotime($value));
            $year = date("Y", strtotime($value));
            $action = new Order();
            $totalView = $action->overview_ViewByDate($month, $date, $year);
            $totalOrder = $action->overview_OrderByDate($month, $date, $year);
            $totalCost = $action->overview_CostByDate($month, $date, $year);
            $result = [$totalCost, $totalView,  $totalOrder];

            $data = Order::selectRaw('dishes.dishid, COUNT(orders.orderid) as totalorder, SUM(orderdishes.quantity * dishes.dishprice) as totalcost')
                ->join('orderdishes', 'orders.orderid', '=', 'orderdishes.orderid')
                ->join('dishes', 'orderdishes.dishid', '=', 'dishes.dishid')
                ->whereDay('orders.created_at', '=', $date)
                ->whereMonth('orders.created_at', '=', $month)
                ->whereYear('orders.created_at', '=', $year)
                ->groupBy('dishes.dishid')
                ->orderByDesc($orderBy)
                ->take(4)
                ->get();
            foreach ($data as $d) {
                $d['info'] = Dishe::find($d['dishid'])->load('dishimages')->load('orderdish');
            }
            return [$result, $data];
        } else if ($type === "year") {
            $action = new Order();
            $totalView = $action->overview_ViewByYear($value);
            $totalOrder = $action->overview_OrderByYear($value);
            $totalCost = $action->overview_CostByYear($value);
            $result = [$totalCost, $totalView,  $totalOrder];

            $data = Order::selectRaw('dishes.dishid, COUNT(orders.orderid) as totalorder, SUM(orderdishes.quantity * dishes.dishprice) as totalcost')
                ->join('orderdishes', 'orders.orderid', '=', 'orderdishes.orderid')
                ->join('dishes', 'orderdishes.dishid', '=', 'dishes.dishid')
                ->whereYear('orders.created_at', '=', $value)
                ->groupBy('dishes.dishid')
                ->orderByDesc($orderBy)
                ->take(4)
                ->get();
            foreach ($data as $d) {
                $d['info'] = Dishe::find($d['dishid'])->load('dishimages')->load('orderdish');
            }
            return [$result, $data];
        }
    }
}
