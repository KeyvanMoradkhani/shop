<?php

namespace App\Http\Controllers\Admin;

use App\AtrributeGroup;
use App\AtrributeValue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AtrributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $atrributesValue =AtrributeValue::with('atrributeGroup')->get();
        return view('administrator/atrributes-value/index',compact(['atrributesValue']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $atrributesValue =AtrributeValue::all();
        $atrributesGroup =AtrributeGroup::all();
        return view('administrator/atrributes-value/create',compact('atrributesValue','atrributesGroup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $atrributesValue =new AtrributeValue();
        $atrributesValue->title =  $request->input('title');
        $atrributesValue->atrributeGroup_id =  $request->input('atrributesValue_type');
        $atrributesValue->save();
        return redirect('/administrator/atrributes-value');
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
        $atrributeValue =AtrributeValue::with('atrributeGroup')->where('id',$id)->first();
        $atrributesGroup =AtrributeGroup::all();
        return view('administrator/atrributes-value/edit',compact(['atrributeValue','atrributesGroup']));
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
        $atrributesValue =AtrributeValue::findOrFail($id);
        $atrributesValue->title =  $request->input('title');
        $atrributesValue->atrributeGroup_id =  $request->input('atrributesValue_type');
        $atrributesValue->save();
        Session::flash('update_atrributesValue' , ' مقدار ویژگی '. '"'. $atrributesValue->title .'"' .' با موفقیت ویرایش شد .');
        return redirect('/administrator/atrributes-value');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $atrributesValue =AtrributeValue::findOrFail($id);
        $atrributesValue->delete();
        Session::flash('delete_atrributesValue' , ' مقدار ویژگی  '. '"'. $atrributesValue->title .'"' .' با موفقیت حذف شد .');
        return redirect('/administrator/atrributes-value');
    }
}
