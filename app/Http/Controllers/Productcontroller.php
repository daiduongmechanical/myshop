<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dishe;
use App\Models\Dishimage;
use Illuminate\Database\QueryException;
use App\Models\Dishingredient;
use App\Models\warehouse;

class Productcontroller extends Controller
{


    public function index()
    {
        $data = Dishe::with('dishimages')->get();

        return view('product.index', ['products' => $data]);
    }

    public function create()
    {
        $material = warehouse::all();
        return view('product.create', ['material' => $material]);
    }

    public function newDish(Request $request)
    {

        try {

            $action = new  Dishe();
            $data = $request->all();
            $files = $request->file('dishimg');
            $result = $action->addDish($data, $files);

            session()->put('success', 'Add dish successfully');
            return redirect('product/index');
        } catch (QueryException $ex) {
            $errorCode = $ex->errorInfo[1];
            return view('product.create', ['error' => $errorCode]);
        }
    }

    public function update($id)
    {
        $dishData = new Dishe();
        $material = warehouse::all();
        $data = $dishData::find($id)->load('dishimages')->load('ingredients');
        return view('product.update', ['product' => $data, 'material' => $material]);
    }

    public function updateData(Request $request)
    {
        try {

            $data = new Dishe();
            $dishid = $request->dishid;


            // update data in dishes table
            $dishData =  $data::find($dishid)->update([
                'dishname' => $request->dishname,
                'dishprice' => $request->dishprice,
                'type' => $request->type,
                'description' => $request->description,
            ]);

            //update data in dish ingredients table
            $dataIngredient = new Dishingredient();

            for ($i = 0; $i < \count($request->materialname); $i++) {
                $dataIngredient::updateOrCreate([
                    'ingredientcode' => $request->materialname[$i],
                    'dishid' => $dishid
                ], [
                    'ingredientcode' => $request->materialname[$i],
                    'mass' => $request->materialmass[$i],
                    'dishid' => $dishid,
                ]);
            }

            //update data in dishimages table
            if (isset($request->imagesDelete)) {
                foreach ($request->imagesDelete as $d) {
                    Dishimage::find((int)$d)->delete();
                }
            }
            if (isset($request->dishimg)) {
                $files = $request->file('dishimg');
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
            }

            \session()->put('success', 'Update successfully');
            return back();
        } catch (QueryException $ex) {
            $errorCode = $ex->errorInfo[1];
            $dishData = new Dishe();
            $data = $dishData::find($dishid)->load('dishimages')->load('ingredients');
            return view('product.update', ['error' => $errorCode, 'product' => $data]);
        }
    }

    public function delete($id)
    {
        try {
            $action = new Dishe();
            $action::find($id)->delete();



            session()->put('success', 'Hided dish successfully');
            return redirect('product/index');
        } catch (QueryException $ex) {
            $errorCode = $ex->errorInfo[1];
            $data = $action::all();
            return view('product.index', ['error' => $errorCode, 'products' => $data]);
        }
    }

    public function oldDishes()
    {
        $action = new Dishe();
        $result =  $action::onlyTrashed()->get();
        return view('product.oldDish', ['products' => $result]);
    }

    public function restore($id)
    {
        $action = new Dishe();
        $result = $action::withTrashed()->where('dishid', $id)->restore();
        if ($result !== 0) {

            $data =  $action::onlyTrashed()->get();
            session()->put('success', 'Restored dish successfully');
            return redirect()->back();
        } else {
            $data =  $action::onlyTrashed()->get();
            session()->put('error', 'Have errors');
            return redirect()->back();
        }
    }

    public function foreDelete($id)
    {
        try {
            $action = new Dishe();
            $result = $action::withTrashed()->where('dishid', $id)->forceDelete();
            if ($result != 0) {
                $data =  $action::onlyTrashed()->get();
                return view('product.oldDish', ['products' => $result, 'products' => $data, 'success' => 'Delete successfully']);
            }
        } catch (QueryException $ex) {
            $errorCode = $ex->errorInfo[1];
            $data =  $action::onlyTrashed()->get();
            return view('product.index', ['error' => $errorCode, 'products' => $data]);
        }
    }
}
