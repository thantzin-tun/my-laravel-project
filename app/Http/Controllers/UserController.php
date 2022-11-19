<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use App\Models\OrderList;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Component\HttpFoundation\RateLimiter\RequestRateLimiterInterface;

class UserController extends Controller
{

    private function checkUserAccountValidation($request)
    {
        Validator::make($request->all(), [
            'email' => 'required | unique:users,email,' . $request->user_id,
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ], [
            'email.required' => "အီးမေးလိပ်စာထည့်သွင်းပေးပါ",
            'name.required' => "အမည်ထည့်သွင်းပေးပါ",
            'address.required' => "လိပ်စာထည့်သွင်းပေးပါ",
            'phone.required' => "ဖုန်းနံပါတ်ထည့်သွင်းပေးပါ",

        ])->validate();
    }

    private function requestToArray($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }



    //User Home Page
    public function userhome()
    {

        $cartCount = Cart::count();

        $data = Product::orderBy('id', 'desc')->get();

        $product = Product::count();

        $cateList = Category::select('id', 'name')->get();

        return view('user.userHome', compact('data', 'product','cateList','cartCount'));
    }


    //User Contact Page
    public function contact(){
        return view('user.contact');
    }


    //Search Operation (Catgory, Price) Function
    public function selectOperations($params)
    {
        switch ($params) {
            case is_numeric($params):
                $data = Product::select("products.*")
                    ->join('categories', 'products.category_id', 'categories.id')
                    ->where('categories.id', $params)
                    ->get();
                break;
            case ($params == 'greater'):
                $data = Product::select("products.*")
                    ->join('categories', 'products.category_id', 'categories.id')
                    ->orwhere('products.price', '>', 10000)
                    ->get();
                break;
            case ($params == 'lower'):
                $data = Product::select("products.*")
                    ->join('categories', 'products.category_id', 'categories.id')
                    ->orwhere('products.price', '<', 10000)
                    ->get();
                break;
            default:
                break;
            }
            return $data;
    }

    //Search Product Category and Price
    public function searchproductwithsomething(Request $request)
    {
        // $result = Product::find($request->route('id'))->category;
        // return $result;
        $product = Product::count();
        $cartCount = Cart::count();

        $cateList = Category::select('id', 'name')->get();

        $cate = Category::select('id', 'name')->get();

        $data = $this->selectOperations($request->route('whatIs'));

        return view('user.userHome', compact('data', 'cateList','product','cartCount'));
    }

    //Change user account Infomation
    public function changeuseraccount(Request $request)
    {

        $this->checkUserAccountValidation($request);
        $data = $this->requestToArray($request);

        if ($request->hasFile('image')) {
            // $dbImage = User::where('id', $request->id)->first();

            // $userImage = $dbImage->image;

            // if ($userImage !== null) {
            //     Storage::delete('public/' . $dbImage);
            // }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        User::where('id', $request->user_id)->update($data);
        return back();
    }

    public function changeuserpassword(Request $request)
    {
        Validator::make($request->all(), [
            'oldpassword' => 'required | min:8',
            'newpassword' => 'required | min:8 ',
            'confirmpassword' => 'required | min:8 | same:newpassword',
        ])->validate();

        $originalPass = User::where('id', Auth::user()->id)->first();

        
        //အနောက်က pass အဟောင်းကို မူလပုံစံအတိုင်း ပြောင်းပီး ရှေ့က user ရိုက်ထည့်တယ့် ဟာနဲ့ တိုက်စစ်တာ
        if (Hash
            ::check($request->oldpassword, $originalPass->password)
        ) {
            User::where('id', $originalPass->id)->update([
                'password' => Hash::make($request->newpassword),
            ]);
            Auth::logout();
        }

        return back()->with(['notMatch' => 'The old password is not match.Try again!']);
    }


    // public function userOrder(){
    //     $data = Cart::select('products.price','carts.qty as quantity','carts.product_id as productID','carts.user_id as useID','products.name')
    //             ->join('products', 'products.id','carts.product_id')
    //             ->where('carts.user_id',Auth::user()->id)->get();
        
    //             dd($data->toArray()); 
               
    //                 OrderList::create([
    //                     'useID' => Auth::user()->id,
    //                     'productID' => $data->productID,
    //                     'quantity' => $data->quantity,
    //                     'total'=> $data->qty * $data->price,
    //                     'order_code' => 1
    //                 ]);
                
    //         }

    
    //User Seach Product In User Home Page
    public function userSearch(){
        $data = Product::when(request('key'),function($query){
                $query->where('name','like','%'. request('key') .'%');
        })->orderBy('id','desc')->get();
        $cate = Category::select('id', 'name')->get();
        return view('user.userHome',compact('data','cate'));
    }


                
    //Contact To Admin Team
    public function contactadminTeam(Request $request){

        Validator::make($request->all(), [
            'contact_email' => 'required | unique:contacts,email',
            'contact_name' => 'required | string',
            'contact_message' => 'required | string',
        ], [
            'contact_email.required' => "အီးမေးလိပ်စာထည့်သွင်းပေးပါ",
            'contact_name.required' => "အမည်ထည့်သွင်းပေးပါ",
            'contact_name.required' => "အမည်ထည့်သွင်းပေးပါ",
            'contact_message.string' => "အကြောင်းအရာထည့်သွင်းပေးပါ",
            'contact_message.required' => "အကြောင်းအရာထည့်သွင်းပေးပါ",
        ])->validate();
        
        Contact::create([
            'name' => $request->contact_name,
            'email' => $request->contact_email,
            'message' => $request->contact_message,
        ]);

        return back();

    }
    

}
