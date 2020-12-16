<?php

namespace App\Http\Controllers\Frontend;

use App\AtrributeGroup;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProduct($slug)
    {
        $product = Product::with(['photos' , 'atrributevalues.atrributeGroup','categories', 'brand'])->where('slug' , $slug)->get()->first();
        $relationProduct =Product::with('categories')->whereHas('categories',function ($q) use ($product){
           $q->whereIn('id',$product->categories);
        })->get();
        return view('frontend.product.index', compact(['product','relationProduct']));
    }

    public function GetAllProductByCategory($id ,$page = 10)
    {
        $category = Category::where('id' , $id)->first();
        $products =  Product::with('categories' , 'photos')->whereHas('categories' ,function ($q) use ($category){
           $q->where('id' , $category->id);
        })->paginate($page);

        return view('frontend.category.index' ,compact(['category','products']));
    }


    public function getApiProduct($id)
    {
        $products =  Product::with('categories' , 'photos')->whereHas('categories' ,function ($q) use ($id){
            $q->where('id' , $id);
        })->paginate(2);
        $response = [
            'products' =>  $products
        ];
        return response()->json($response,200);
    }

    public function getApiSortProduct($id,$SortByPrice,$pagination)
    {
        $products =  Product::with('categories' , 'photos')->whereHas('categories' ,function ($q) use ($id){
            $q->where('id' , $id);
        })
            ->orderBy('price' ,$SortByPrice)
            ->paginate($pagination);
        $response = [
            'products' =>  $products
        ];
        return response()->json($response,200);
    }
    public function getApiAttributeGroups($id){
        $attributeGroups = AtrributeGroup::with('atrributeValue')
            ->whereHas('categories' ,function ($q) use ($id){
            $q->where('category_id' , $id);
        })->get();
        $response = [
            'attributeGroups' =>  $attributeGroups
        ];
        return response()->json($response,200);
    }

    public function getApiFilterProduct($id,$SortByPrice,$pagination,$attribute)
    {
        $attributeArray =  json_decode($attribute , true);

        $products =  Product::with('categories' , 'photos')
            ->whereHas('categories' ,function ($q) use ($id){
            $q->where('id' , $id);
        })
            ->whereHas('atrributevalues' ,function ($q) use ($attributeArray){
                $q->whereIn('atrributesValue_id' , $attributeArray);
            })
            ->orderBy('price' ,$SortByPrice)
            ->paginate($pagination);

        $response = [
            'products' =>  $products
        ];
        return response()->json($response,200);
    }
}
