<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Dishe;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dishimage extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = array('dishid', 'imageurl');

    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dishe::class, 'dishid');
    }
}
