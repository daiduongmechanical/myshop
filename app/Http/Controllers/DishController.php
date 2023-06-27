<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dishe;
use App\Models\Rate;
use App\Models\warehouse;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $action = new  Dishe();
        $type = $request->type;
        $value = $request->value;
        $toDay = date('Y-m-d');

        $result = $action::when($value == 'all', function ($query) {
            $query->get();
        })->when($value != 'all', function ($query) use ($value) {
            $query->where('type', 'like', $value);
        })->when($type == 'downprice', function ($query) {
            $query->orderBy('dishprice', 'desc');
        })->when($value == 'price', function ($query) {
            $query->orderBy('dishprice', 'asc');
        })->when($type != 'price' && $type != 'downprice', function ($query) use ($type) {
            $query->orderBy('dishname', $type);
        })->with('dishimages')->with(['discountdishes.discount' => function ($query) use ($toDay) {
            $query->where('startdate', '<=', $toDay)
                ->where('enddate', '>=', $toDay);
        }])->get();

        foreach ($result as $e) {
            if (count($e->discountdishes) === 0) {
                $e['discount'] = false;
            } else {
                $check = 0;
                $position = 0;
                for ($i = 0; $i < count($e->discountdishes); $i++) {
                    if ($e->discountdishes[$i]->discount != null) {
                        $check++;
                        $position = $i;
                    }
                }
                if ($check === 0) {
                    $e['discount'] = false;
                } else {
                    $e['discount'] = true;
                    $e['discountdata'] = $e->discountdishes[$position]->discount;
                }
            }
            unset($e['discountdishes']);
        }



        return $result;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $action = new  Dishe();
        $data = $request->all();

        $files = $request->file('dishimg');
        $result = $action->addDish($data, $files);

        return $request->$result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $action = new Dishe();
        $result = $action->getDish($id);
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
        $action = new Dishe();
        $data = $request->all();
        $result = $action->updateDish($id, $data);
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
        $action = new Dishe();
        $result = $action->deleteDish($id);
        return dd($result);
    }

    public function more(Request $request)
    {
        $action = new Dishe();
        $result = $action->newSale($request->dishid);
        return $result;
    }

    //get list 4 new dishes

    public function newDishList()
    {
        $action = new Dishe();
        $result = $action::with('dishimages')->orderBy('created_at', 'DESC')->take(4)->get();
        return $result;
    }

    //get top 4 best rate dishes

    public function getRatelist()
    {
        $data = Rate::selectRaw('rates.dishid,AVG(mark)as average')
            ->join('dishes', 'dishes.dishid', 'rates.dishid')
            ->whereNull('dishes.deleted_at')
            ->groupBy('rates.dishid')
            ->with('dish.dishimages',)
            ->take(4)->get();
        return $data;
    }

    public function ingredient()
    {
        $result =   warehouse::all();
        return $result;
    }

    public function hello(Request $request)
    {

        return $request->all();
    }
}
