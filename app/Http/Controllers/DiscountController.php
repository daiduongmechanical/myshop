<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Dishe;
use App\Models\Discountdish;
use Exception;

class DiscountController extends Controller
{
    //method for mvc

    public function all()
    {
        $action = new Discount();
        $result = $action->getAllDiscount();
        return view('discount.index', ['discounts' => $result]);
    }

    //route to discount create pate
    public function store(Request $request)
    {
        $data = Dishe::all();

        return view('discount.create', ['dishes' => $data]);
    }

    //create newwsave
    public function postCreate(Request $request)
    {
        $discount = new Discount();
        $discount->newSale($request);
        $result = $discount->getAllDiscount();
        return view('discount.index', ['discounts' => $result, 'success' => 'add discount successfully']);
    }

    // route to discount edit page
    public function edit($discountid)
    {
        $discount = Discount::find($discountid);
        $dishes = Dishe::all();
        $discountedDishes = DiscountDish::where('discountid', $discountid)->get();

        return view('discount.update', ['discount' => $discount, 'dishes' => $dishes, 'discountedDishes' => $discountedDishes]);
    }

    // edit discount

    public function postEdit(Request $request)
    {
        try {
            $data = $request->all();
            $discount = Discount::findOrFail($data['id']);

            $discount->discountname = $data['name'];
            $discount->discountamount = $data['price'];
            $discount->startdate = $data['start_sale_date'];
            $discount->enddate = $data['end_sale_date'];
            $discount->save();

            // Delete existing discount dishes
            DiscountDish::where('discountid', $data['id'])->delete();
            // Insert new discount dishes
            if (isset($data['checkbox'])) {
                foreach ($data['checkbox'] as $item) {
                    DiscountDish::create([
                        'dishid' => $item,
                        'discountid' => $data['id'],
                    ]);
                }
            }


            session()->put('success', 'Update discount successfully');
            return redirect('discount/index');
        } catch (Exception $e) {
            session()->put('error', "Can't create discount. Because no dish selected ");
            return redirect('discount/index');
        }
    }

    //delete discount
    public function delete($id)
    {
        try {

            // Delete data from discounts table
            Discount::where('discountid', $id)->delete();


            session()->put('success', "Delete discount successfully");
            return back();
        } catch (Exception $e) {

            session()->put('error', "Delete fail, please set list dish of discount is null befor delete");
            return back();
        }
    }
}
