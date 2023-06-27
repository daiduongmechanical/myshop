<?php

namespace App\Models;

use App\Models\Dishe as ModelsDishe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Undefined;
use App\Models\Dishimage;
use App\Models\Dishingredient;
use App\Models\orderdish as ModelsOrderdish;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use orderdish;
use App\Models\Discountdish;
use Illuminate\Events\Dispatcher;
use App\Models\Rate;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dishe extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = array('dishname', 'dishprice', 'description', 'type');
    protected $primaryKey = 'dishid';

    // relation ship with  carts model
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'dishid');
    }

    // relationship with dish image model
    public function dishimages(): HasMany
    {
        return $this->hasMany(Dishimage::class, 'dishid');
    }
    //relationship with orderdish table
    public function orderdish(): BelongsTo
    {
        return $this->belongsTo(ModelsOrderdish::class, 'dishid');
    }

    // relationship wit igredient table
    public function ingredients(): HasMany
    {
        return $this->hasMany(Dishingredient::class, 'dishid');
    }

    //relationship with discountdish table
    public function discountdishes(): HasMany
    {
        return $this->hasMany(Discountdish::class, 'dishid');
    }

    //relationship with rate table
    public function rate(): HasMany
    {
        return $this->hasMany(Rate::class, 'dishid');
    }







    public function getDish($id)
    {
        $toDay = date('Y-m-d');
        $dish = Dishe::find($id);
        $result = $dish->load('dishimages')->load(['discountdishes.discount' => function ($query) use ($toDay) {
            $query->where('startdate', '<=', $toDay)
                ->where('enddate', '>=', $toDay);
        }]);

        if (count($result->discountdishes) === 0) {
            $result['discount'] = false;
            unset($result['discountdishes']);
            return $result;
        } else {
            $check = 0;
            $position  = 0;
            for ($i = 0; $i < count($result->discountdishes); $i++) {
                if ($result->discountdishes[$i]->discount != null) {
                    $check++;
                    $position = $i;
                }
            }

            if ($check !== 0) {
                $result['discount'] = true;
                $result['discountdata'] = $result->discountdishes[$position]->discount;
                unset($result['discountdishes']);
                return $result;
            } else {
                $result['discount'] = false;
                unset($result['discountdishes']);
                return $result;
            }
        }
    }

    public function deleteDish($id)
    {
        $result = Dishe::where('dishid', $id)->delete();
        return $result;
    }


    public function addDish($data, $files)
    {
        $materialMass = $data['materialmass'];
        $materialName = $data['materialname'];
        // insert data to dish table
        $result = Dishe::create([
            'dishname' => $data['dishname'],
            'dishprice' => $data['dishprice'],
            'type' => $data['type'],
            'description' => $data['description'],
        ]);
        //upload image and insert to dishimages table
        $dishid = $result->dishid;
        foreach ($files  as $item) {
            $imageName = time() . rand(0, 10000) . '.' . $item->extension();
            $item->move(public_path('images'), $imageName);
            Dishimage::create(
                [
                    'dishid' => $dishid,
                    'imageurl' => 'http://localhost:8000/images/' . $imageName,
                ]
            );
        }

        // insert data to dishingredient table
        for ($i = 0; $i < count($materialMass); $i++) {
            Dishingredient::create(
                [
                    'dishid' => $dishid,
                    'ingredientcode' => $materialName[$i],
                    'mass' => $materialMass[$i]
                ]
            );
        }

        return $result;
    }



    public function updateDish($data, $id)
    {
        $action = Dishe::find($id);


        $action->dishname = $data['dishname'];
        $action->dishprice = $data['dishprice'];
        $action->type = $data['dishtype'];
        $action->description = $data['description'];
        $result = $action->save();
        return $result;
    }

    public function newSale($data)
    {
        return $data;
    }
}
