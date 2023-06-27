<?php

namespace App\Models;

use App\Models\orderdish as ModelsOrderdish;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Node\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use App\Models\Dishe;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Discount;




class Order extends Model



{
    use HasFactory;

    protected $fillable = array('userid', 'type', 'detail', 'status', 'totalcost', 'checkout', 'feeship');
    protected $primaryKey = 'orderid';


    //relationship with  orderdish table
    public function orderDishes(): HasMany
    {
        return $this->hasMany(ModelsOrderdish::class, 'orderid');
    }

    //relationship with user table
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userid');
    }



    public function addOrder($data)
    {

        $result =  Order::create([
            'detail' => $data['detail'],
            'type' => $data['type'],
            'userid' => $data['userid'],
            'status' => isset($data['status']) ? "finished" : "waiting",
            'totalcost' => $data['totalCost'],
            'feeship' => $data['feeship']
        ]);
        $id = $result['orderid'];
        $dish = DB::table('carts')->where('userid', "=", (int)$data['userid'])->get();
        //  them du lieu vao bang orders item
        foreach ($dish as $item) {
            ModelsOrderdish::create(
                [
                    'quantity' => $item->quantity,
                    'orderid' => $id,
                    'dishid' => $item->dishid,
                    'require' => $item->required,
                    'discountid' => $item->discountid,

                ]
            );
        }
        //xoa du lieu tai bang cart
        DB::table('carts')->where('userid', '=', $data['userid'])->delete();
        return $result;
    }

    public function getAllOrder($sort, $day, $search)

    {

        $result = Order::when($day, function ($query, $day) {
            $query->whereRaw('CAST( Orders.created_at AS date) = ' . "'" . $day . "'");
        })
            ->when($sort, function ($query, $sort) {
                $query->where('status', $sort);
            })->when($search, function ($query, $search) {
                $query->where('OrderID', $search);
            })->with('user')
            ->with('orderDishes')->orderBy('created_at', 'desc')->paginate(8);

        $data = $result->toArray();
        for ($i = 0; $i < count($data['data']); $i++) {
            for ($j = 0; $j < count($data['data'][$i]['order_dishes']); $j++) {
                $data['data'][$i]['order_dishes'][$j]['dish'] = Dishe::withTrashed()->find($data['data'][$i]['order_dishes'][$j]['dishid'])->load('dishimages');

                if ($data['data'][$i]['order_dishes'][$j]['discountid'] === null) {
                    $data['data'][$i]['order_dishes'][$j]['discount'] = false;
                } else {
                    $data['data'][$i]['order_dishes'][$j]['discount'] = true;
                    $data['data'][$i]['order_dishes'][$j]['discountdata'] = Discount::find($data['data'][$i]['order_dishes'][$j]['discountid']);
                }
            }
        }


        return  $data;
    }


    //get number of orders

    public function getNumberOrders()
    {

        $result = Order::count();
        return $result;
    }

    // get order by userID
    public function getOrderbyUserID($id, $all)
    {

        $result = Order::when($all == 0, function ($query) {
            $query->where('Orders.status', 'like', 'finished');
        })
            ->when($all == 1, function ($query) {
                $query->Where(function ($query) {
                    $query->where('Orders.status', 'like', 'delivery')
                        ->orwhere('Orders.status', 'like', 'waiting')
                        ->orwhere('Orders.status', 'like', 'accept');
                });
            })->where('Orders.userid', $id)
            ->with([
                'user', 'orderdishes'
            ])
            ->get();

        foreach ($result as $e) {

            for ($i = 0; $i < count($e->orderdishes); $i++) {
                $e->orderdishes[$i]['dish'] = Dishe::withTrashed()->find($e->orderdishes[$i]->dishid)->load('dishimages');

                if ($e->orderdishes[$i]->discountid === null) {
                    $e->orderdishes[$i]['discount'] = false;
                } else {
                    $e->orderdishes[$i]['discount'] = true;
                    $e->orderdishes[$i]['discountdata'] = Discount::find($e->orderdishes[$i]->discountid);
                }
            }
        }

        return $result;
    }

    public function getOrderbyOrderID($id)
    {
        $result = Order::find($id)->load('user')->load('orderDishes.dish.dishimages', 'orderDishes.dish.discount');
        return $result;
    }

    public function updateStatus($id, $status)
    {
        $action =  Order::find($id);
        $action->status = $status;
        $result = $action->save();
        return $result;
    }

    public function totalOrderByMonth($month, $year)
    {
        $reusult = Order::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();

        return $reusult;
    }

    public function totalCostByMonth($month, $year)
    {
        $reusult = Order::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)->whereIn('status', ['finished', 'accept', 'delivery'])
            ->sum('TotalCost');

        return $reusult;
    }



    public function overview_OrderByMonth($month, $year)
    {
        $result = Order::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->whereIn('status', ['delivery', 'finished'])
            ->count();
        return $result;
    }
    public function overview_ViewByMonth($month, $year)
    {
        $result = view::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            
            ->count();
        return $result;
    }
    public function overview_CostByMonth($month, $year)
    {
        $reusult = Order::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)->whereIn('status', ['finished', 'accept', 'delivery'])
            ->sum('TotalCost');

        return $reusult;
    }
    public function overview_OrderByDate($month, $date, $year)
    {
        $result = Order::whereMonth('created_at', $month)
            ->whereDay('created_at', $date)
            ->whereYear('created_at', $year)
            ->whereIn('status', ['delivery', 'finished'])
            ->count();
        return $result;
    }
    public function overview_ViewByDate($month, $date, $year)
    {
        $result = view::whereMonth('created_at', $month)
            ->whereDay('created_at', $date)
            ->whereYear('created_at', $year)
            ->count();
        return $result;
    }
    public function overview_CostByDate($month, $date, $year)
    {
        $result = Order::whereMonth('created_at', $month)
            ->whereDay('created_at', $date)
            ->whereYear('created_at', $year)->whereIn('status', ['finished', 'accept', 'delivery'])
            ->sum('totalcost');
        return $result;
    }
    public function overview_OrderByYear($year)
    {
        $result = Order::whereYear('created_at', $year)
        ->whereIn('status', ['delivery', 'finished'])
            ->count();
        return $result;
    }
    public function overview_ViewByYear($year)
    {
        $result = view::whereYear('created_at', $year)
            ->count();
        return $result;
    }
    public function overview_CostByYear($year)
    {
        $result = Order::whereYear('created_at', $year)->whereIn('status', ['finished', 'accept', 'delivery'])
            ->sum('totalcost');
        return $result;
    }
}
