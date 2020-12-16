<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands =  Brand::with('photo')->get();

        return view('administrator/brands/index',compact(['brands']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator/brands/create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand  = new Brand();
        $brand->title = $request->title;
        $brand->description = $request->description;
        $brand->photo_id = $request->photo_id;
        $brand->save();
        Session::flash('add_brand' , ' برند با موفقیت اضافه شد.');
        return redirect('administrator/brands');
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
        $brand =  Brand::with('photo')->where('id',$id)->first();
        return view('administrator/brands/edit',compact(['brand']));
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
        $brand  = Brand::findOrFail($id);
        $brand->title = $request->title;
        $brand->description = $request->description;
        $brand->photo_id = $request->photo_id;
        $brand->save();
        Session::flash('update_brand' , ' برند با موفقیت ویرایش شد.');
        return redirect('administrator/brands');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand  = Brand::findOrFail($id);
        $brand->delete();
        Session::flash('delete_brand' , ' برند با موفقیت حذف شد.');
        return redirect('administrator/brands');

    }
}
