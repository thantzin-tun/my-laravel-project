<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Faker\Core\Number;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class ProductController extends Controller
{

    private function checkProductValidation($request){

        $validationRules = [
                'name' => 'required | min:4 | string | unique:products,name,' . $request->id,
                'category_id' => 'required',
                'description' => 'required | string | max:30',
                'image' => 'mimes:png,jpg,jpeg | file',
                'price' => 'integer',
                'waiting' => 'integer'
        ];


        $validationMessage = [
                'name.required' => "ပစ္စည်းအမျိုးအမည် ထည့်သွင်းပေးပါ",
                'name.string' => "ပစ္စည်းအမျိုးအမည် ထည့်သွင်းပေးပါ",
                'name.unique' => "ခေါင်းစဥ◌်တူနေပါသည်",
                'name.min' => "အနည်းဆုံးငါးလုံးရှိရပါမည်",
                'description.required' => "အကြောင်းအရာထည့်သွင်းပေးပါ",
                'description.max' => "အရေတွက်ကျော်လွန်နေပါသည်",
                'description.string' => "နာမည်ဖြစ်ရပါမည်",
                'price.integer' => "တန်ဖိူးထည့်သွင်းပေးပါ",
                'waiting.integer' => "ကြာမြင့်ချိန် ထည့်သွင်းပေးပါ",
        ];

        Validator::make($request->all(),$validationRules,$validationMessage)->validate();
    }

    private function requestToArray($request){
        return [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'waiting' => $request->waiting,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ];
    }

    public function adminProduct(){
        $cate = Category::select('id','name')->get();
        $product = Product::when(request('key'),function($query){
            if(is_numeric(request('key'))){
                $query->orwhere('price','>','%'. request('key') .'%');
            }
            else {
                $query->where('name','like','%'. request('key') .'%');
            }
        })->orderBy('id','desc')->paginate(3);
        $data = User::where('role','admin')->get();
        return view('admin.adminProduct',compact('product','cate','data')); 
        // return url()->previous();
        return url()->current();

    }


    //Create Product
    public function createProduct(Request $request){
        $this->checkProductValidation($request);
        $data = $this->requestToArray($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id', $request->id)->first();
            $userImage = $dbImage->image;

            if ($userImage != null) {
                Storage::delete('public/' . $dbImage);
            }
            
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;        
        }

        Product::create($data);
        return redirect()->route('admin#productList');
    }


    //Update Product
    public function updateProduct(Request $request){

        $this->checkProductValidation($request);
        $data = $this->requestToArray($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id', $request->id)->first();
            $userImage = $dbImage->image;

            if ($userImage != null) {
                Storage::delete('public/' . $dbImage);
            }
            
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;        
        }
        
        Product::where('id',$request->id)->update($data);
        return back();
    }


    //Delete Product
    public function deleteProduct(Request $request){
        Product::destroy($request->product_id);
        return redirect()->route('admin#productList');
    }

}
