<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        $products=Product::all();   // Retrieve all products from the database
        return view("user_index",compact("products"));  // Return the view with the list of products
    }
    public function ProductInfo(Request $request, Product $product){
        
        // Return the view with detailed information about the specified product
        return view('product_view',compact("product"));
    }
}
