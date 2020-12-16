<?php

namespace App\Http\Controllers\Frontend;

use App\Address;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterValidation;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function UserRegister(UserRegisterValidation $request)
    {
        $user =new User();
        $user->name =  $request->input('name');
        $user->last_name =  $request->input('last_name');
        $user->email =  $request->input('email');
        $user->phone =  $request->input('phone');
        $user->national_code =  $request->input('national_code');
        $user->gender =  $request->input('gender');
        $user->password = Hash::make($request->input('password'));
        $user->save();


        $addresses = new Address();
        $addresses->company =  $request->input('company');
        $addresses->addresses =  $request->input('address');
        $addresses->post_code =  $request->input('post_code');
        $addresses->city_id =  $request->input('city_id');
        $addresses->province_id =  $request->input('province_id');
        $addresses->user_id = $user->id;
        $addresses->save();

        Session::flash('add_user' , 'کاربر با موفقیت ثبت شد');
        return redirect('/login');

    }

    public function profile(Request $request)
    {
//        return $request->all();
        $user=  Auth::user();
        return view('frontend.profile.profile',compact('user'));
    }

    public function AllOrderUser($id)
    {
        $orders =  Order::with('user')->where('user_id' ,$id)->get();
        $user=  Auth::user();
        return view('frontend.profile.order',compact(['orders','user']));
    }

    public function getListOrder($id)
    {
        $order =Order::with(['products.photos','user.addresses.province','user.addresses.city'])->whereId($id)->first();
        $user=  Auth::user();
        return view('frontend.profile.list' , compact(['order','user']));
    }
}
