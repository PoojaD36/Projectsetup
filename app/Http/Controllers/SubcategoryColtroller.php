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
            //dd($subcategories->first()->status); 
            $categories = Category::all();
        return view('categories.subcategories', compact('subcategories','categories'));
    }
    function subcategoryAdd(Request $request)
    {
         $validated = $request->validate([
            'name' => 'required',
            'image' => 'nullable',
            'description' => 'nullable',
            'category_id' => 'required|numeric',
            'status' => 'required|in:active,inactive',
            'price' => 'required',
            
        ]);

        $subcategory = new Subcategory;
        $subcategory->name= $request->name;
        $subcategory->description= $request->description;
        //$subcategory->image= $request->image;
               if ($image = $request->file('image')) {
        $destinationPath = 'image/'; // Define the directory where you want to store the image

        // Generate a unique filename using current date/time and the original extension
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

        // Move the uploaded image to the destination folder
        $image->move($destinationPath, $profileImage);

        // Save the image filename (path) in the database
        $subcategory->image = $destinationPath . $profileImage;
    }
        $subcategory->category_id = $request->category_id;
        $subcategory->status = strtolower($request->status);
        $subcategory->price = $request->price;
        $result =  $subcategory->save();


            return redirect()->route('subcategory-view')
                ->with('success', 'Subcategory created successfully!');
    }

    function editSubcategory($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::all();
       
        return view('categories.subcategory_edit', compact('subcategory', 'categories'));
    }

    function updateSubcategory(Request $request,$id)
    {
     
       $subcategory = Subcategory::find($id);
$subcategory->update([
    'name' => $request->name,
    'description' => $request->description,
    'price' => $request->price,
    'status'=> $request->status,
]);

        return response()->json(['success' => 'Subcategory updated successfully']);
    }

}
