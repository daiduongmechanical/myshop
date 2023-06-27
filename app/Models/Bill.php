<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = array('amount', 'type', 'orderid', 'accountno');
    protected $primaryKey = 'billid';


    public function cashPayment($id)
    {
        $data = Order::find($id);
        $result = Bill::create([
            'amount' => $data->totalcost,
            'type' => 'cash',
            'orderid' => $id,

        ]);

        return $result;
    }
}
