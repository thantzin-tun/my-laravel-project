<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // Proucut and If parameter 
    public function getProductList(Request $request){

        $parameter = $request->route()->parameters();

        if(!empty($parameter)){
            $data = Product::orderBy('id','desc')->get();
        }
        else {
            $data = Product::get();
        }
        return response()->json($data,200);
    }

    //Get Category
    public function getProductCategory(){
        $data = Category::get();
        return response()->json($data,200);
    }

    //Both product and category
    public function all(){
        $product = Product::get();
        $category = Category::get();

        $data = [
            'product' => $product,
            'category' => $category,
        ];

        return response()->json($data,200);
    }


    //Create Category
    public function createCategory(Request $request){

    //    logger($request->all());
     $data = [
        'name' => $request->name
     ];

     Category::create($data);

     return response()->json("Successfully Create!",200);
    
    }

    //Create Category
    public function deleteCategory(Request $request){
         Category::destroy($request->id);
         return response()->json("Successfully Delete!",200);
    }


    //Update Api
    public function updateCategory(Request $request){
        Category::where('id',$request->id)->update([
            'name' => $request->name
        ]);
        return response()->json("Successfully Update!",200);
   }

}
