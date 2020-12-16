<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products  = Product::paginate(5);
        return view('administrator/products/index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $categories =  Category::with('childrenRecursive')->where('parent_id',null)->get();
        $brands =  Brand::all();
        return view('administrator/products/create',compact(['brands']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function generateSKU(){
        $numberSKU =  mt_rand(10000,99999);
        if($this->checkSKU($numberSKU)){
            return $this->generateSKU();
        }else{
            return $numberSKU;
        }
     }
     public function checkSKU($numberSKU){

        return Product::where('sku',$numberSKU)->exists();
     }
     public function makeSlug($string){
         $string=str_replace(['؟','?'],'',$string);
         return preg_replace('/\s+/u' , '-' ,trim($string));
     }
    public function store(Request $request)
    {
        $newproduct  = new Product();
        $newproduct->title=$request->title;
        $newproduct->sku=$this->generateSKU();
        $newproduct->slug=$this->makeSlug($request->slug);
        $newproduct->status=$request->status;
        $newproduct->price=$request->price;
        $newproduct->discount_price=$request->discount_price;
        $newproduct->description=$request->description;
        $newproduct->meta_title=$request->meta_title;
        $newproduct->meta_desc=$request->meta_desc;
        $newproduct->meta_keywords=$request->meta_keywords;
        $newproduct->brand_id=$request->brand;
        $newproduct->user_id=1;
        $newproduct->save();

        $attributes = explode(',',$request->input('attributes')[0]);
        $photos = explode(',',$request->input('photo_id')[0]);

        $newproduct->categories()->sync($request->categories);
        $newproduct->atrributevalues()->sync($attributes);
        $newproduct->photos()->sync($photos);

        Session::flash('add_product' , 'محصول با موفقیت اضافه شد.');
        return redirect('/administrator/products');


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
        $brands =  Brand::all();
        $product =  Product::with('categories','brand','atrributevalues','photos')->whereId($id)->first();
        return view('administrator/products/edit',compact(['brands','product']));
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

        // return $request->all();
        $product  = Product::findOrFail($id);
        $product->title=$request->title;
        $product->sku=$this->generateSKU();
        // $product->slug=$this->makeSlug($request->slug);
        $product->slug=$request->slug;
        $product->status=$request->status;
        $product->price=$request->price;
        $product->discount_price=$request->discount_price;
        $product->description=$request->description;
        $product->meta_title=$request->meta_title;
        $product->meta_desc=$request->meta_desc;
        $product->meta_keywords=$request->meta_keywords;
        $product->brand_id=$request->brand;
        $product->user_id=1;
        $product->save();

        $attributes = explode(',',$request->input('attributes')[0]);
        $photos = explode(',',$request->input('photo_id')[0]);

        $product->categories()->sync($request->categories);
        $product->atrributevalues()->sync($attributes);
        $product->photos()->sync($photos);

        Session::flash('update_product' , 'محصول با موفقیت ویرایش شد.');
        return redirect('/administrator/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product  = Product::findOrFail($id);
        $product->delete();

        Session::flash('delete_product' , 'محصول با موفقیت حذف شد.');
        return redirect('/administrator/products');
    }
}
