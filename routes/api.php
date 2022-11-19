<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Api Get Product List
Route::get("/productList/{status?}",[ApiController::class,'getProductList']);


//Api Get Category List
Route::get("/categoryList",[ApiController::class,'getProductCategory']);


//Api Get Product and Category in One Route
Route::get("/all",[ApiController::class,'all']);


//Api Create Data 
Route::post("/create/category",[ApiController::class,'createCategory']);


//Api Delete Data 
Route::delete("/delete/category/{id}",[ApiController::class,'deleteCategory']);


//Api Update Data 
Route::put("/update/category/{id}",[ApiController::class,'updateCategory']);

