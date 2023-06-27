<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class view extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'dishid', 'userid'
    ];
    protected $primaryKey = 'viewid';


    public function addView($userID, $dishID)
    {

        $result =   view::create([
            'dishid' => $dishID,
            'userid' => $userID
        ]);
        return $result;
    }

    public function totalViewByMonth($month, $year)
    {
        $result = view::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();
        return $result;
    }
}
