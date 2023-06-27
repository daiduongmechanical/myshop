<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dishe;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dishingredient extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = array('dishid', 'ingredientcode', 'mass');

    //relationships with dishes table
    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dishe::class, 'dishid');
    }
}
