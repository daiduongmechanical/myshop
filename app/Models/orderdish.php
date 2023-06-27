<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dishe;
use Illuminate\Database\Eloquent\SoftDeletes;
use Order;


class orderdish extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = array('dishid', 'discountid', 'quantity', 'orderid', 'require');
    protected $primaryKey = 'orderdishid';


    // relationship with order table
    public function Order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'orderid');
    }
    //relationship with dish table
    public function dish(): HasOne
    {
        return $this->hasOne(Dishe::class, 'dishid', 'dishid');
    }
}
