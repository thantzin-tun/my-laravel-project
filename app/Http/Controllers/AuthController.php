<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class AuthController extends Controller
{
    private function checkCategoryValidation($request){
        Validator::make($request->all(),[
            'name' => 'required | min:4 ',
            'email' => 'required | min:4 | unique:users,email,' . $request->id,
            'phone' => 'required',
            'address' => 'required | min:4 ',
            'image' => 'mimes:png,jpg,jpeg | file'
        ])->validate();
    }

    public function accountData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role
        ];
    }


    //Login Page
    public function loginPage(){
        return view('login');
    }

    //Registe Page
    public function registerPage(){
        return view('register');
    }

    //Check Route Admin or user to go
    public function checkRoute(){

        // if(url()->previous() == 'http://localhost:8000/registerPage'){
        //     return redirect('/loginPage');
        // }
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin#dash');
            }
            else {
                return redirect()->route('user#page');
            }
        
    }

    //Change Password Page and Change Password
    public function changePage(){
        $data = User::where('role','admin')->get();
        return view('admin.changePassword',compact('data'));
    }
    
    //Change Password Function
    public function changePassword(Request $request){
        Validator::make($request->all(),[
            'oldpassword' => 'required | min:8' ,
            'newpassword' => 'required | min:8 ',
            'confirmpassword' => 'required | min:8 | same:newpassword',
        ])->validate();

        $originalPass = User::where('id',Auth::user()->id)->first();
        
        //အနောက်က pass အဟောင်းကို မူလပုံစံအတိုင်း ပြောင်းပီး ရှေ့က user ရိုက်ထည့်တယ့် ဟာနဲ့ တိုက်စစ်တာ
        if(Hash::check($request->oldpassword,$originalPass->password)){
            User::where('id',$originalPass->id)->update([
                'password' => Hash::make($request->newpassword),
            ]);
            Auth::logout();
        }

        return back()->with(['notMatch' => 'The old password is not match.Try again!']);
    }
    //


    //To go Account Info Page and Change Account Info
    public function changeaccountInfo(Request $request){

        $this->checkCategoryValidation($request);
        $data = $this->accountData($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id',$request->id)->first();
            $userImage = $dbImage->image;
            
            if($userImage != null) {
                Storage::delete('public/'.$dbImage);
                }
                $fileName = uniqid() . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public',$fileName);
                $data['image'] = $fileName;
            }
            
        User::where('id',$request->id)->update($data);
        return back();
    }
}

