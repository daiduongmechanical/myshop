<?php

namespace App\Models;

use App\Models\Discount as ModelsDiscount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Discountdish;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = array('discountname', 'discountamount', 'startdate', 'enddate', 'object');
    protected $primaryKey = 'discountid';

    //relationship with discountdish table
    public function dishes(): HasMany
    {
        return $this->hasMany(Discountdish::class, 'discountid');
    }

    public function newSale($data)
    {

        // tem du lieu vao bang discount

        $action = Discount::create([
            'discountname' => $data->name,
            'discountamount' => $data->price,
            'startdate' => $data->start_sale_date,
            'enddate' => $data->end_sale_date,
            'object' => $data->object
        ]);
        $newID = $action->discountid;

        // add data to discountdish table
        foreach ($data->checkbox as $item) {
            DB::table('DiscountDishes')->insert([
                'dishid' => $item,
                'discountid' => $newID
            ]);
        }
    }
    //
    public function getAllDiscount()
    {
        $result = Discount::get();
        return $result;
    }

    //get discount by day
    public function getDiscount()
    {
        $toDay = date('Y-m-d');
        $result = Discount::where('Discounts.startdate', '<=', $toDay)
            ->where('Discounts.enddate', '>=', $toDay)->with('dishes')->get();

        return $result;
    }
    // get discount by dishid
    public function getdDiscountByDishID($id)
    {
        $toDay = date('Y-m-d');
        $result = Discount::join('discountDishes', 'DiscountDishes.DiscountID', 'Discounts.DiscountID')
            ->where('Discounts.StartDate', '<=', $toDay)
            ->where('Discounts.EndDate', '>=', $toDay)
            ->where('DiscountDishes.DishID', $id)
            ->get();

        return $result;
    }
    public function getdDiscountByDiscountID($id)
    {
        $result = Discount::join('discountDishes', 'DiscountDishes.DiscountID', 'Discounts.DiscountID')
            ->join('dishes', 'discountDishes.DishID', 'dishes.dishid')
            ->where('DiscountDishes.DiscountID', $id)
            ->get();
        return $result;
    }

    public function updateDiscount($data, $id, $dishid)
    {
        $result =  Discount::find($id)->update(
            [
                'DiscountName' => $data['DiscountName'],
                'DiscountAmount' => $data['DiscountAmount'],
                'StartDate' => $data['StartDate'],
                'EndDate' => $data['EndDate'],
                'object' => $data['object'],
            ]
        );

        // xoa data cu
        DB::table('DiscountDishes')->where('DiscountID', $id)->delete();
        // them  du lieu moi
        foreach ($dishid as $item) {
            DB::table('DiscountDishes')->insert([
                'DishID' => $item,
                'DiscountID' => $id
            ]);
        }
        return $result;
    }
}
