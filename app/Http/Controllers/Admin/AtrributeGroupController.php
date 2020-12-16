<?php

namespace App\Http\Controllers\Admin;

use App\AtrributeGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AtrributeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atrributes =AtrributeGroup::all();
        return view('administrator/atrributes/index',compact(['atrributes']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $atrributes =AtrributeGroup::all();
        return view('administrator/atrributes/create',compact('atrributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $atrribute =new AtrributeGroup();
        $atrribute->title =  $request->input('title');
        $atrribute->type =  $request->input('atrributes_type');
        $atrribute->save();
        return redirect('/administrator/atrributes');
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
        $atrribute =AtrributeGroup::findOrFail($id);
        return view('administrator/atrributes/edit',compact('atrribute'));
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
        $atrribute =AtrributeGroup::findOrFail($id);
        $atrribute->title =  $request->input('title');
        $atrribute->type =  $request->input('atrributes_type');
        $atrribute->save();
        Session::flash('update_atrributes' , 'ویژگی '. '"'. $atrribute->title .'"' .' با موفقیت ویرایش شد .');
        return redirect('/administrator/atrributes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $atrribute =AtrributeGroup::findOrFail($id);
        $atrribute->delete();
        Session::flash('delete_atrributes' , 'ویژگی  '. '"'. $atrribute->title .'"' .' با موفقیت حذف شد .');
        return redirect('/administrator/atrributes');
    }
}
