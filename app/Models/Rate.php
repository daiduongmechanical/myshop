<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Dishe;

class Rate extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = array('mark', 'comment', 'userid', 'dishid', 'orderid');
    protected $primaryKey = 'rateid';

    //relationships with user table
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userid');
    }

    //relationships with dishes table
    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dishe::class, 'dishid');
    }

    public function addRate($data)
    {
        $result =  Rate::create([
            'dishid' => $data['dishID'],
            'mark' => $data['raiting'],
            'userid' => $data['userID'],
            'comment' => $data['comment'],
            'orderid' => $data['orderID'],
        ]);

        return $result;
    }



    public function getDishRateByOrderid($id)
    {
        $result = Rate::where('orderid', $id)->get();
        return $result;
    }

    public function getDishRateByDishid($id)
    {
        $result = Rate::where('dishid', $id)->with('user')->get();
        return $result;
    }
}
