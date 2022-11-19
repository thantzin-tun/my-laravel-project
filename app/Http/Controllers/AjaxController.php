<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\OrderList;
use App\Models\Product;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Js;
use Symfony\Component\HttpKernel\Event\RequestEvent;

use function PHPSTORM_META\map;

class AjaxController extends Controller
{

    //Ajax Sorting So, Can't not send compact or view, etc...only return response.data
    public function sortingAjax(Request $request)
    {
        if ($request->status == 'asc') {
            $data = Product::orderBy('created_at', 'asc')->get();
        } else {
            $data = Product::orderBy('created_at', 'desc')->get();
        }
        return $data;
    }


    //Add To Cart if product same Don't insert new row and add one qty in cart table
    //This is ajax so.You can't return blade file
    public function addToCart(Request $request)
    {

        $customer = Cart::where('user_id', $request->userID)->where('product_id', $request->pizzaID)->first();

        $totalPizza = Cart::where('user_id', Auth::user()->id)->get();

        if ($customer) {
            Cart::where('user_id', $request->userID)->where('product_id', $request->pizzaID)->update([
                'qty' => $customer->qty + 1
            ]);
        } else {
            Cart::create([
                'user_id' => $request->userID,
                'product_id' => $request->pizzaID,
                'qty' => $request->quantity,
            ]);
        }
        return $totalPizza;
    }


    //Increase or decrease
    public function cartmanage(Request $request)
    {
        $customer = Cart::where('user_id', $request->userID)->where('product_id', $request->pizzaID)->first();
        if ($request->status == "increase") {
            Cart::where('user_id', $request->userID)->where('product_id', $request->pizzaID)->update([
                'qty' => $customer->qty + 1
            ]);
        } else {
            if ($customer->qty == 0) {
                return;
            }
            Cart::where('user_id', $request->userID)->where('product_id', $request->pizzaID)->update([
                'qty' => $customer->qty - 1
            ]);
        }
        $customer = Cart::where('user_id', $request->userID)->where('product_id', $request->pizzaID)->first();
        return $customer->qty;
    }


    //Add To Card show page
    public function userorderpage()
    {

        $result = Product::select("products.*", "carts.*")
            ->join("carts", "products.id", "carts.product_id")
            ->where('carts.user_id', Auth::user()->id)->get();

        if (count($result) === 0) {
            return back();
        } else {
            $totalPrice = 0;
            foreach ($result as $c) {
                $totalPrice += $c->price * $c->qty;
            }
            return view('user.userCart', compact('result', 'totalPrice'));
        }
    }


    //Delete You Cart Prodcut One By One in UserCard Page
    public function userdeleteOrder(Request $request)
    {

        Cart::where('cart_id', $request->route('deleteOrder'))->delete();

        $product = Product::count();

        $result = Product::select("products.*", "carts.*")
            ->join("carts", "products.id", "carts.product_id")
            ->where('carts.user_id', Auth::user()->id)->get();

        if (count($result) === 0) {
            $data = Product::orderBy('id', 'desc')->get();
            $cateList = Category::select('id', 'name')->get();
            $product = Product::count();
            $cartCount = Cart::count();
            return view('user.userHome', compact('data', 'cateList', 'product', 'cartCount'));
        }
        return back();
    }


    //All Delete Order Card data in UserCard Page
    public function userorderalldelete()
    {

        $product = Product::count();
        $cartCount = Cart::count();


        Cart::where('user_id', Auth::user()->id)->delete();

        $data = Product::orderBy('id', 'desc')->get();

        $cateList = Category::select('id', 'name')->get();

        return view('user.userHome', compact('data', 'cateList', 'product', 'cartCount'));
    }



    //Add Data to OrderList Table Wit Ajax
    public function finalOrder(Request $request)
    {
        foreach ($request->all() as $singleOrder) {
            OrderList::create([
                'useID' => Auth::user()->id,
                'productID' => $singleOrder['productID'],
                'quantity' => $singleOrder['quantity'],
                'total' => $singleOrder['total'],
                'order_code' => $singleOrder['order_code'],
            ]);
        }

        Cart::where("user_id", Auth::user()->id)->delete();

        return response()->json([
            'status' => "Successfully"
        ], 200);
    }


    //Send Require Data to OrderView Modal Box with ajax in admin.orderlistPage
    public function orderView(Request $request)
    {

        $code = OrderList::distinct('order_code')->pluck('order_code');

        $orderInformation = OrderList::select("products.name as productName", "users.name as userName", "order_lists.quantity", "order_lists.total", "order_lists.order_code")
            ->join("users", "order_lists.useID", "users.id")
            ->join("products", "order_lists.productID", "products.id")
            ->where("order_code", $request->code)
            ->get();

        return response()->json($orderInformation,200);

    }
}
