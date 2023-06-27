<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\warehouse;
use App\Models\view;
use App\Models\Warehouseaction;
use Exception;
use Illuminate\Database\QueryException;

class Materialcontroller extends Controller
{

    public function index()
    {
        $data = warehouse::all();
        return view('warehouse.index', ['warehouses' => $data]);
    }
    public function view($ingredientcode)
    {
        $data = warehouse::find($ingredientcode);
        return view('warehouse.view', ['warehouses' => $data]);
    }
    public function create()
    {
        return view('warehouse.create');
    }


    public function postCreate(Request $request)
    {
        try{
            $product = $request->all();
            $p = new warehouse($product);
            $p->save();
            session()->put('success', 'create Successfully');
            return redirect('warehouse/index');
        }catch(QueryException $ex){
         $errorCode = $ex->errorInfo[1];
         if($errorCode==1062){
            session()->put('error', 'ID has already existed');
            return redirect('warehouse/index');
         }
         if($errorCode==4025){
            session()->put('error', 'Quantity must bigger than 0');
            return redirect('warehouse/index');
         }
        }
      
    }



    public function delete($ingredientid)
    {
        try {
            $p = warehouse::find($ingredientid);
            $p->delete();
            session()->put('success', 'This material has been deleted Successfully');
            return redirect('warehouse/index');
        } catch (Exception $e) {
            session()->put('error', "Can't delete this material, because it is using in dishes");
            return redirect('warehouse/index');
        }
    }


    public function edit($ingredientcode)
    {
        $data = warehouse::find($ingredientcode);
        return view('warehouse.edit', ['warehouses' => $data]);
    }

    public function postEdit(Request $request)
    {
        $ingredientid = $request->ingredientid;
        $warehouse = warehouse::find($ingredientid);
        $warehouse->name = $request->name;
        $warehouse->mass = $request->quantity;
        $warehouse->save();
        return redirect('warehouse/index')->with('status', 'Create successful');
    }
    public function overview()
    {
        $data = warehouse::all();
        return view('warehouse.overview', ['warehouses' => $data]);
    }
    public function history()
    {
        $data = warehouseaction::all();
        foreach ($data as $d) {
            $d['name'] = warehouse::find($d->ingredientcode)->name;
        }

        return view('warehouse.history', ['warehouseactions' => $data]);
    }
}
