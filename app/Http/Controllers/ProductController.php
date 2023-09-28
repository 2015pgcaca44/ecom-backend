<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use Validator;

class ProductController extends Controller
{
    function products(){
        $products = Products::get();
        return $products;
    }

    function getProducts($id){
        $products = Products::where('id', $id)->first();
        return \Response::json(['message'=>'success', 'data'=>$products], 200);
    }

    function createProducts(Request $request){
        $products = new Products();
        $validator = Validator::make($request->all(), [
            'pname' => 'required', 
            'pbrand' => 'required',  
            'pprice' => 'required', 
            'pcategory' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $products->name = $request->input("pname");
        $products->brand = $request->input("pbrand");
        $products->category = $request->input("pcategory");
        $products->price = $request->input("pprice");
        $products->sku = $request->input("psku");
        $products->description = $request->input("pdescription");
        $products->image = $request->input("pimage");
        $products->save();
        return $products;
    }
    function update(Request $request){
        //$products = new Products();
        $validator = Validator::make($request->all(), [
            'pid' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $params = array(
            'name' => $request->input("pname"),
            'brand' => $request->input("pbrand"),
            'category' => $request->input("pcategory"),
            'price' => $request->input("pprice"),
            'sku' => $request->input("psku"),
            'description' => $request->input("pdescription"),
            'image' => $request->input("pimage")
        );
        Products::where('id',$request->pid)->update($params);
        return \Response::json(['message'=>'Updated success', 'data'=> $request->all()], 200);
    }
    function delete(Request $request){
        // \DB::enableQueryLog();
        $id = $request->all();
        $products = Products::where('id',$id[0])->delete();
        // dd(\DB::getQueryLog());
        return \Response::json(['message'=>'deleted success'], 200);
    }
}
