<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Index(){
        $products = product::with('image')->get();
        return view('poornima.addpizza',compact('products'));
    }

    public function storeproduct(Request $request){
        $validatedData= $request->validate([
            'name'       =>'required|string',
            'description'=>'required|string',
            'status'     =>'required|integer',
            'small'      =>'required|numeric',
            'medium'     =>'required|numeric',
            'large'      =>'required|numeric',
            'image_link' =>'required|image|mimes:jpeg,png|max:2048',
        ]);

        if($request->hasFile('image_link')){
            $imagePath = $request->file('image_link')->store('slides','public');
        }

        $product=product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'small' => $validatedData['small'],
            'medium' => $validatedData['medium'],
            'large' => $validatedData['large'],
            
            
        ]);

        ProductImage::create([
            'product_id' => $product->id,
            'image' => $imagePath,
            
        ]);
        


        return redirect()->back()->with('success','Slide added Successfully !');
    }
    public function list(){
        return view('poornima.productmenu');  
    }

    
}
