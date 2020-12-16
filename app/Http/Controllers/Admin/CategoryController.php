<?php

namespace App\Http\Controllers\Admin;

use App\AtrributeGroup;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =  Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->get();
        return view('administrator/category/index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =  Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->get();
        return view('administrator/category/create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
        */
        public function store(Request $request)
    {
        $category =new Category();
        $category->name =  $request->input('name');
        $category->parent_id =  $request->input('parent_category');
        $category->meta_title =  $request->input('meta_title');
        $category->meta_desc =  $request->input('meta_desc');
        $category->meta_keywords =  $request->input('meta_keywords');
        $category->save();
        return redirect('/administrator/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories =  Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->get();
        $category =  Category::findOrFail($id);

        return view('administrator/category/edit',compact(['categories','category']));
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
        $category = Category::findOrFail($id);
        $category->name =  $request->input('name');
        $category->parent_id =  $request->input('parent_category');
        $category->meta_title =  $request->input('meta_title');
        $category->meta_desc =  $request->input('meta_desc');
        $category->meta_keywords =  $request->input('meta_keywords');
        $category->save();
        Session::flash('update_category' , 'دسته بندی '. '"'. $category->name .'"' .' با موفقیت ویرایش شد .');

        return redirect('/administrator/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $category = Category::with('childrenRecursive')->where('id',$id)->first();

        if (count($category->childrenRecursive)>0){
            Session::flash('delete_error_category' , 'دسته بندی '. '"'. $category->name .'"' .' دارای زیر دسته های است.امکان حذف کردن این دسته وجود نداره.');
            return redirect('/administrator/categories');
        }else{
            $category->delete();
            Session::flash('delete_category' , 'دسته بندی '. '"'. $category->name .'"' .' با موفقیت حذف شد .');
            return redirect('/administrator/categories');
        }

    }

    public function indexSetting($id)
    {
        $atrributesGroup =AtrributeGroup::all();
        $category = Category::findOrFail($id);
        return view('administrator/category/setting',compact(['atrributesGroup','category']));
    }

    public function saveSetting(Request $request,$id)
    {
        $category = Category::findOrFail($id);
        $category->atrributesGroup()->sync($request->atrributesGroup);
        $category->save();
        return redirect('/administrator/categories');
    }

    public function apiIndex()
    {
        $categories =  Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->get();
        $response = [
          'categories' =>  $categories
        ];
        return response()->json($response,200);
    }
    public function apiIndexAttribute(Request $request){
        $categories = $request->all();
        $attributes = AtrributeGroup::with('atrributeValue','categories')
        ->whereHas('categories', function($q) use ($categories){
            $q->whereIn('categories.id',$categories);
        })->get();
        $response = [
            'attribute' =>  $attributes
          ];
          return response()->json($response,200);
    }
}
