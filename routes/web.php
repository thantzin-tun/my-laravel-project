<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;

//Login and Register Page
Route::redirect('/','loginPage');

Route::get('/loginPage',[AuthController::class,'loginPage'])->name('login#page');

Route::get('/registerPage',[AuthController::class,'registerPage'])->name('register#page');
//Login and Register Page


Route::get('productist',[AuthController::class,'ajaxFunc']);


Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/','loginPage');
    
    Route::get('/loginPage',[AuthController::class,'loginPage'])->name('login#page');
    
    Route::get('/registerPage',[AuthController::class,'registerPage'])->name('register#page');
 });


Route::middleware([
    'auth'
])->group(function () {

    Route::get('dashboard',[AuthController::class,'checkRoute'])->name('dashboard');

    Route::group(['prefix' => 'adminPage','middleware' => 'admin_auth'],function(){

        //Admin Home Page Route
        Route::get('/adminDash',[AdminController::class,'adminDash'])->name('admin#dash');

        //User List Page in Admin Panel
        Route::get('/userList',[AdminController::class,'userListPage'])->name('user#List'); 

        //Change User Role to Admin Role .Notice Ajax Controller No need route name
         Route::get('/changeRole',[AdminController::class,'changeRole']);
        

        //Categories(Create,Update,Delete) route  
        Route::post('/createCategory',[AdminController::class,'createCategory'])->name('admin#create');
        Route::get('/edit',[AdminController::class,'editCategory'])->name('edit#category');
        Route::post('/delete',[AdminController::class,'deleteCategory'])->name('delete#category');


        //Change Password
        Route::get('/changePassword',[AuthController::class,'changePage'])->name('admin#changePasswordPage');
        Route::post('/password',[AuthController::class,'changePassword'])->name('admin#changePassword');


        //Update Account Information 
        Route::get('/accountInfo',[AdminController::class,'accountInfo'])->name('account#info');
        Route::post('/changeInfo',[AuthController::class,'changeaccountInfo'])->name('change#info');


        //Product (Create,Update,Delelte) Routes
        Route::get('/productList',[ProductController::class,'adminProduct'])->name('admin#productList');
        Route::post('/createproduct',[ProductController::class,'createProduct'])->name('create#product');
        Route::post('/updateproduct',[ProductController::class,'updateProduct'])->name('update#product');
        Route::post('/deleteproduct',[ProductController::class,'deleteProduct'])->name('delete#product');

        //Search Admin List Box
        Route::post('/adminList',function(){
            return "Is Working?";
        })->name("admin#search");


        //Contact User List
        Route::get('/contactList',function(){
            
         $data = Contact::when(request('key'),function($query){
                $query->where('name','like','%'. request('key') .'%');
        })->orderBy('contact_id','desc')->get();
        return view('admin.contactList',compact('data'));
        })->name("contact#List");

        // OrderList page
        Route::get("/orderListPage",[AdminController::class,'orderListPage'])->name("orderList#page");


        //OrderList Modal Box Show in admin.orderList Page
        Route::get("/orderView",[AjaxController::class,'orderView']);



        //Search OrderCode in admin.orderListPage SearchBox
        // Route::get("/ordercodesearch",[AdminController::class,'ordercodesearch'])->name("ordercode#search");


    });

    Route::group(['prefix' => 'user','middleware' => 'user_auth'],function(){
        
        //User Home Page After User Login
        Route::get('page', [UserController::class,'userhome'])->name('user#page');

        
        //User Home Page After User Login
        Route::get('contactus', [UserController::class,'contact'])->name('contact#us');

        
        //Search Product with Category
        Route::get('searchproductwithsomething/{whatIs?}', [UserController::class,'searchproductwithsomething'])->name('search#productwithsomething');

        
        //Change User Account Info
        Route::post('changeuseraccount',[UserController::class,'changeuseraccount'])->name('change#useraccount');
        Route::post('changeuserpassword',[UserController::class,'changeuserpassword'])->name('change#userpassword');


        //Sorting Ajax Asc or Desc
        Route::get('pizzaList',[AjaxController::class,'sortingAjax']);


        //Add To Cart Not change Page
        Route::get('addToCart',[AjaxController::class,'addToCart']);


        //Go to UserCardPage and Show Info
        Route::get('order/page',[AjaxController::class,'userorderpage'])->name('userorder#page');

        //User Increasing or Decreasing Pizza in Card
        Route::get('/cartmanage',[AjaxController::class,'cartmanage']);


         //Final Order
         Route::get('/userOrder',[UserController::class,'userOrder'])->name('user#order');


         //User Search All Prodcut In Search Box
         Route::get('/usersearch',[UserController::class,'userSearch'])->name('user#search');


         //User Cart Delete One By One
        Route::get('order/delete/{deleteOrder?}',[AjaxController::class,'userdeleteOrder'])->name('user#deleteOrder');


         //Delete All Card Data in UserCart Page
         Route::get('/userorderalldelete',[AjaxController::class,'userorderalldelete'])->name('userorder#alldelete');


         //Contact Email To Admin Team
         Route::post("/contactadminTeam",[UserController::class,'contactadminTeam'])->name("contact#adminTeam");


         //Add To OrderList Tabel with Ajax
         Route::get("/userOrder",[AjaxController::class,'finalOrder']);


    });
    
});
