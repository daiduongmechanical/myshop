<?php

namespace App\Models;

use App\Models\Cart as ModelsCart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Dishe;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = array('userid', 'dishid', 'quantity', 'required', 'discountid', 'totalcost');
    protected $primaryKey = 'cartid';


    //relationship with  table dishes

    // relationship with table user
    public function post(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userid');
    }

    // relationship with table user
    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dishe::class, 'dishid');
    }



    // get list  cart by userid
    public function showCart($id)
    {
        $toDay = date('Y-m-d');

        $result = Cart::join('dishes', 'dishes.dishid', 'carts.dishid')->where('userid', $id)
            ->whereNull('deleted_at')
            ->with('dish.dishimages')
            ->with(['dish.discountdishes.discount' => function ($query) use ($toDay) {
                $query->where('startdate', '<=', $toDay)
                    ->where('enddate', '>=', $toDay);
            }])->get();





        foreach ($result as $e) {
            if (count($e->dish->discountdishes) === 0) {
                $e['discount'] = false;
                unset($e->dish['discountdishes']);
            } else {
                $check = 0;
                $position = 0;
                for ($i = 0; $i < count($e->dish->discountdishes); $i++) {
                    if ($e->dish->discountdishes[$i]->discount != null) {
                        $check++;
                        $position = $i;
                    }
                }
                if ($check === 0) {
                    $e['discount'] = false;
                    unset($e->dish['discountdishes']);
                } else {
                    $e['discount'] = true;
                    $e['discountdata'] = $e->dish->discountdishes[$position]->discount;
                    unset($e->dish['discountdishes']);
                }
            }
        }



        return $result;
    }
    public function updateCart($id, $quantity, $require)
    {
        $action = Cart::find($id);
        $action->quantity = $quantity;
        $action->required = $require;
        $result = $action->save();
        return $result;
    }

    public function deleteCart($id)
    {
        $action = Cart::find($id);
        $result = $action->delete();
        return $result;
    }

    public function addToCart($userid, $dishid, $quantity, $discount)
    {
        if ($discount == 0) {

            $result = Cart::updateOrCreate(
                [
                    'dishid' =>  $dishid,
                ],
                [
                    'userid' => $userid,
                    'dishid' => $dishid,
                    'quantity' => $quantity,
                ]
            );
        } else {
            $result = Cart::updateOrCreate(
                [
                    'dishid' =>  $dishid,
                ],
                [
                    'userid' => $userid,
                    'dishid' => $dishid,
                    'quantity' => $quantity,
                    'discountid' => $discount,
                ]
            );
        }

        return $result;
    }
}
