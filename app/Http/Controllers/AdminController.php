<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderList;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    private function checkCategoryValidation($request)
    {
        Validator::make($request->all(), [
            'category' => 'required | min:4 | unique:categories,name,' . $request->category_id
        ], [
            'category.required' => "အမျိုးအမည် ထည့်သွင်းပေးပါ",
            'category.unique' => "ခေါင်းစဥ◌်တူနေပါသည်"
        ])->validate();
    }

    private function requestToArray($request)
    {
        return [
            'name' => $request->category,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    //This function is get All category in database and Paginate and Search Category
    public function adminDash()
    {
        $result = Category::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })->orderBy('id', 'desc')->paginate(4);

        $data = User::where('role', 'admin')->get();
        // dd($data->toArray());
        return view('admin.adminDash', compact('result', 'data'));
    }
    //


    //This function is adminDash
    public function adminContact()
    {
        return view('admin.adminDash');
    }


    //This function is create new categories
    public function createCategory(Request $request)
    {
        $this->checkCategoryValidation($request);
        $data = $this->requestToArray($request);
        Category::create($data);
        return redirect()->route('admin#dash');
    }


    //This function is delete category with Modal Box
    public function deleteCategory(Request $request)
    {
        Category::destroy($request->category_id);
        return redirect()->route('admin#dash');
    }


    //This fucntion is Update category with Modal Box
    public function editCategory(Request $request)
    {
        $this->checkCategoryValidation($request);
        $data = $this->requestToArray($request);
        Category::where('id', $request->category_id)->update($data);
        return redirect()->route('admin#dash');
    }


    //Go to acount Info Page
    public function accountInfo()
    {
        $data = User::where('role', 'admin')->get();
        return view('admin.accountInfo', compact('data'));
    }



    //User List Page 
    public function userListPage()
    {

        $userList = User::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })->where('role', 'user')->orderBy('id', 'desc')->get();

        $data = User::where('role', 'admin')->get();

        return view('admin.userList', compact('data', 'userList'));
    }


    //Ajax Controller
    public function changeRole(Request $request)
    {
        if ($request->status == 'user') {
            User::where('id', $request->id)->update([
                'role' => 'user'
            ]);
        } else {
            User::where('id', $request->id)->update([
                'role' => 'admin'
            ]);
        }
    }

    //OrderList Page
    public function orderListPage()
    {
        $data = User::where('role', 'admin')->get();

        $code = OrderList::distinct('order_code')->pluck('order_code');

        // $orderCodeList = OrderList::when(request('key'), function ($query) {
        //     $query->where('order_code', 'like', '%' . $mycode . '%');
        // })->distinct('order_code')->pluck('order_code');

        return view("admin.orderList",compact('data','code'));
    }


    //Search OrderCode
    // public function ordercodesearch(){

    //     $mycode = "OrderCode"+request('key');

    //     $orderCodeList = OrderList::when(request('key'), function ($query) {
    //         $query->where('order_code', 'like', '%' . $mycode . '%');
    //     })->orderBy('id', 'desc')->get();

    //     $data = User::where('role', 'admin')->get();
    //     $code = OrderList::distinct('order_code')->pluck('order_code');

    //     return view('admin.userList', compact('data', 'userList','data','code'));
    // }
}


// $data = User::when(request('key'),function($query){
//     $query->where('name','like','%'. request('key') .'%');
//     })
//     ->where('role','admin')
//     ->orderBy('id','desc');
// return back(compact('data'));


// [

//     {"productName":"Tuna Fish","userName":"Shwe Sin","quantity":3,"total":10200,"order_code":"OrderCode1397518"},

//     {"productName":"Banana","userName":"Shwe Sin","quantity":1,"total":400,"order_code":"OrderCode1397518"},

//     {"productName":"Durian","userName":"Shwe Sin","quantity":1,"total":7000,"order_code":"OrderCode1397518"}
// ]  