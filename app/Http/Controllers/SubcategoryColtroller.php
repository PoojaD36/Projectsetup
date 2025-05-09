<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubcategoryColtroller extends Controller
{
    function subcategoryView()
    {
        $subcategories = Subcategory::with('category', 'products')
            ->withCount('products')
            ->latest()
            ->get();
            $categories = Category::all();
        return view('categories.subcategories', compact('subcategories','categories'));
    }
    function subcategoryAdd(Request $request)
    {
    
        //  return $request->name;
         $validated = $request->validate([
            'name' => 'required',
            'image' => 'nullable',
            'description' => 'nullable',
            'category_id' => 'required|numeric',
            'status' => 'required',
            'price' => 'required',
            
        ]);
        //return $data = $request->all();

        $subcategory = new Subcategory;
        $subcategory->name= $request->name;
        $subcategory->description= $request->description;
        $subcategory->image= $request->image;
        $subcategory->category_id = $request->category_id;
        $subcategory->status = $request->status;
        $subcategory->price = $request->price;
        $result =  $subcategory->save();

        Subcategory::subcategoryView($validated);

            return redirect()->route('subcategory-view')
                ->with('success', 'Subcategory created successfully!');
    }

    // function subcategoryView(){
    //     return view('categories.subcategories');
    //     return redirect('view-subcategory')->with('success', 'Category created successfully!');

    // }
    
}
