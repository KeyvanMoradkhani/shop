<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('administrator.coupons.index' , compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.coupons.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = new Coupon();
        $coupon->title =  $request->title;
        $coupon->code =  $request->code;
        $coupon->price =  $request->price;
        $coupon->status =  $request->status;
        $coupon->save();

        Session::flash('add_coupon' , ' کد تخفیف با موفقیت اضافه شد.');
        return redirect('administrator/coupons');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('administrator.coupons.edit' , compact('coupon'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->title =  $request->title;
        $coupon->code =  $request->code;
        $coupon->price =  $request->price;
        $coupon->status =  $request->status;
        $coupon->save();

        Session::flash('update_coupon' , ' کد تخفیف با موفقیت ویرایش شد.');
        return redirect('administrator/coupons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        Session::flash('delete_coupon' , ' کد تخفیف با موفقیت حذف شد.');
        return redirect('administrator/coupons');
    }
}
