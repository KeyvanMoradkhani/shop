<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
//        $products = Product::with(['photos' , 'atrributevalues.atrributeGroup','categories', 'brand'])->where('title' ,'like', '%'.$search.'%')->get();
        return view('frontend.search.index',compact(['search']));
//        return view('frontend.search.index', compact(['products' ,'search' ]));
    }

    public function ApiSearchIndex($search_text)
    {

        $products = Product::with(['photos', 'atrributevalues.atrributeGroup', 'categories', 'brand'])
            ->where('title', 'like', '%' . $search_text . '%')->paginate(12);
//        dd($products);
        $response = [
            'products' =>  $products
        ];
        return response()->json($response,200);
    }
}
