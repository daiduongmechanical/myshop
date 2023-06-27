<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warehouse extends Model
{
    use HasFactory;
    protected $fillable = array('ingredientcode', 'mass', 'name');
    protected $primaryKey = 'ingredientcode';
    protected $keyType = 'string';
}
