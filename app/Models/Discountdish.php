<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Discount;
use  App\Models\Dishe;

class Discountdish extends Model
{
    use HasFactory;
    protected $fillable = array('discountid', 'dishid');
    protected $primaryKey = 'id';

    //relation ship with discount table 
    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class, 'discountid');
    }
    //relation ship with dish table 
    public function dishes(): BelongsTo
    {
        return $this->belongsTo(Dishe::class, 'dishid');
    }
}
