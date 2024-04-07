<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    
    public function index(Request $request)
    {
        $brands = Brands::all(); // Fetch all brands
        return view('admin.brands_list', compact('brands')); // Pass brands data to the view
    }
    public function create()
    {
        return view('admin.add_brand'); // Display the form to add a new brand
    }

    public function store(Request $request)
    {
        $brand = new Brands; // Create a new instance of Brands model
        $brand->name = $request['name']; // Set name
        $brand->description = $request['description']; // Set description

        // Upload and save brand image
        $imgName = 'lv_' . rand() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('brands/'), $imgName);
        $brand->image = $imgName;

        $brand->save(); // Save brand data
        return redirect()->route('brands.index')->with('success', 'Brand inserted successfully'); // Redirect with success message
    }
    public function edit(Brands $brand)
    {
       return view('admin.brand_edit', compact('brand')); // Display the form to edit a brand
    }


    public function update(Request $request, Brands $brand)
    {
        $brand->name = $request->name ?? $brand->name;
        $brand->description = $request->description ?? $brand->description;
        $brand->save();

        return redirect()->route('brands.index' )->with('success','brand updates   successfully');

    }
    //Change the image of the specified brand.
    public function changeBrandImage(Request $request, $id)
    {
        $requestData=$request->except(['token','method','regist']);
        $brand=Brands::find($id);

         $imgName='lv_'.rand(). '.' . $request->image->extension();
         $request->image->move(public_path('/brands'), $imgName);
         $requestData['image']=$imgName;
       
        
        $brand->update($requestData);
        
        return redirect()->route('brands.index')->with('success','image image updated!');
    
    }


    // change the status of a brand (active/inactive)
    public function changeBrandStatus(Request $request, $id, $status = 1)
    {
        $brands = Brands::find($id);
        if (!empty($brands)) {
            $brands->is_active = $status;
            $brands->save();
            return redirect()->route('brands.index')->with('success', 'Brand status Updated Successfully!');
        } else {
            return redirect()->route('brands.index')->with('danger', 'Something went wrong.');
        }
    }
}
