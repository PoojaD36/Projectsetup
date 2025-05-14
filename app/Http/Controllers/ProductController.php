<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

use Illuminate\Http\Request;

class ProductController extends Controller
{


public function productView() {
    $products = Product::with(['category', 'subcategory'])->get();
    $categories = Category::all();
    $subcategories = []; // Prevent undefined variable error
    $selectedCategory = null; // Prevent undefined variable error

    return view('categories.product', compact('products','categories', 'subcategories', 'selectedCategory'));
}


function productCreate(Request $request){

    //dd($request);
    $categories = Category::all();
    
        $selectedCategory = $request->old('category_id', $request->input('category_id'));
        
        $subcategories = [];
        if ($selectedCategory) {
            $subcategories = Subcategory::where('category_id', $selectedCategory)->get();
        }
        $products = Product::all();
        return view('categories.product', compact('products','categories', 'subcategories', 'selectedCategory'));
        


        
}

public function updateCategorySelection(Request $request)
    {
        return redirect()->route('product-view')->withInput([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);
        
        $subcategory = Subcategory::find($validated['subcategory_id']);
        if (!$subcategory || $subcategory->category_id != $validated['category_id']) {
            return redirect()->back()
                ->withErrors(['subcategory_id' => 'Invalid subcategory for selected category'])
                ->withInput();
        }
        
        // Handle image upload
    if ($request->hasFile('image')) {
        $destinationPath = 'images/products/'; // Better folder structure
        $profileImage = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
        $request->image->move($destinationPath, $profileImage);
        $validated['image'] = $destinationPath . $profileImage;
    }
        
        Product::create($validated);
        
        return redirect()->route('product-view')
            ->with('success', 'Product created successfully!');
    }


    function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = Subcategory::all();
       
        return view('categories.product_edit', compact('product', 'categories','subcategories'));
    }

    function updateProduct(Request $request,$id)
    {
     
       $product = Product::find($id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'status'=> $request->status,
        ]);

        return response()->json(['success' => 'Category updated successfully']);
    }

    }