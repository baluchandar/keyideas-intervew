<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index(Request $request) 
    {
        $data['categories'] = Category::select('id','name')->orderBy('id','DESC')->get();
        return view('catalog',$data);
    }

    public function get_products(Request $request)
    {
        $obj = Product::select('id','prod_sku','prod_Live_URL','prod_name','attr_14k_regular','attr_whitegold_platinum_round_default_img');
        if($request->priceFrom && $request->priceFrom > 0){
            $obj = $obj->where('attr_14k_regular', '>=',$request->priceFrom);
        }
        if($request->priceTo && $request->priceTo < 200000){
            $obj = $obj->where('attr_14k_regular', '<=',$request->priceTo);
        }
        if($request->gender){
            $genderArr = explode(",",$request->gender);
            if($genderArr) {
                $obj = $obj->whereIn('prodmeta_section',$genderArr);
            }
        }
        
        if($request->category){
            $categoryArr = explode(",",$request->category);
            if($categoryArr) {
                $obj = $obj->whereHas("categories", function($qry) use($categoryArr) {
                    $qry->whereIn('name',$categoryArr);
                });
            }
        }
        if($sortBy = $request->sortBy){
            if($sortBy == 'low-high') {
                $obj = $obj->orderBy('attr_14k_regular','ASC');
            }else if($sortBy == 'high-low') {
                $obj = $obj->orderBy('attr_14k_regular','DESC');
            }else{
                $obj = $obj->orderBy('id','DESC');
            }
        }
        $products = $obj->paginate(12);
        return response()->json([
            'status' => 'success',
            'data' => $products->items(),
            'total' => $products->total(),
            'last_page' => $products->LastPage(),
        ]);
    }
}
