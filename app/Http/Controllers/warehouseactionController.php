<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\warehouse;
use App\Models\Warehouseaction;
use App\Models\Dishingredient;
use Throwable;

class warehouseactionController extends Controller
{
    public function create(Request $request)
    {
        $data = Dishingredient::where('dishid', $request->dishid)->get();
        //tru nguyen lieu
        foreach ($data as $e) {
            $warehouse = warehouse::find($e->ingredientcode);
            if ($warehouse->mass - $e->mass * $request->quantity < 0) {
                abort(400,  $warehouse->name . ' not enough');
            }
        }

        foreach ($data as $e) {
            $warehouse = warehouse::find($e->ingredientcode);
            $warehouse->mass = $warehouse->mass - $e->mass * $request->quantity;
            $warehouse->save();
        }

        foreach ($data as $e) {
            Warehouseaction::create([
                'ingredientcode' => $e->ingredientcode,
                'mass' => - ($e->mass * $request->quantity),
                'description' => $request->description,
                'userid' => $request->userid
            ]);
        }
        return response('Add successfully', 201);
    }
    public function update(Request $request)
    {
        $code = $request->code;
        $mass = $request->mass;

        for ($i = 0; $i < count($code); $i++) {
            $warehouse = Warehouse::find($code[$i]);
            $warehouse->mass = $warehouse->mass + ($mass[$i]);
            $warehouse->save();
        }

        //update lai bang
        for ($i = 0; $i < count($code); $i++) {
            Warehouseaction::create([
                'ingredientcode' => $code[$i],
                'mass' => $mass[$i],
                'description' => 'import materials',
                'userid' => $request->userid
            ]);
        }
        return (response('Update successful.', 201));
    }
}
