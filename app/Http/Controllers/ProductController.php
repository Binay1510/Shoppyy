<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    //Display a listing of the resource.

    public function index()
    {
        $products= Product::all();  
        return view('admin.product_list',compact('products'));  
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands=Brands::all();
        return view('admin.product_add',compact('brands'));   
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product =new Product;
        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->sale_price = $request['sale_price'];
        $product->color = $request['color'];
        $product->brand_id = $request['brand_id'];
        $product->product_code = $request['product_code'];
        $product->gender = $request['gender'];
        $product->function = $request['function'];
        $product->stock = $request['stock'];
        $product->description = $request['description'];
        $imgName = 'lv_' . rand() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('products/'), $imgName);
        $product->image = $imgName;
        $product->save();
        return redirect()->route('product.index' )->with('success','brand inserted successfully');
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands=Brands::all();
        return view('admin.product_edit',compact('brands','product'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->name = $request->name ?? $product->name;
        $product->price = $request->price ?? $product->price;
        $product->sale_price = $request->sale_price ?? $product->sale_price;
        $product->color = $request->color ?? $product->color;
        $product->brand_id = $request->brand_id ?? $product->brand_id;
        $product->product_code = $request->product_code ?? $product->product_code;
        $product->gender = $request->gender ?? $product->gender;
        $product->function = $request->function ?? $product->function;
        $product->stock = $request->stock ?? $product->stock;
        $product->description = $request->description ?? $product->description;
        $product->save();
        return redirect()->route('product.index', [], 301)->with('success', 'Product updated Successfully.');
   
    }
    public function changeProductImage(Request $request, $id)
    {
        $requestData=$request->except(['token','method','regist']);
        $product=Product::find($id);
         $imgName='lv_'.rand(). '.' . $request->image->extension();
         $request->image->move(public_path('/products'), $imgName);
         $requestData['image']=$imgName;
        $product->update($requestData); 
        return redirect()->route('product.index')->with('success','image image updated!');
    }

    public function changeProductStatus(Request $request, $id, $status = 1)
    {
        $product = Product::find($id);
        if (!empty($product)) {
            $product->is_active = $status;
            $product->save();
            return redirect()->route('product.index')->with('success', 'product status Updated Successfully!');
        } else {
            return redirect()->route('product.index')->with('danger', 'Something went wrong.');
        }
    }
}
