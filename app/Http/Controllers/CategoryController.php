<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Session;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
        function categoryAdd()
    {
        $categories = Category::withCount('products')->get();
        return view('categories.category_form', compact('categories'));
    }

    function categoriesList()
    {
        return view('categories.category_list');
    }

    function categoryView(){
        return view('categories.category_form');
    }

    function addCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'fulldesc' => 'nullable',
            'image' => 'nullable',
            'status' => 'nullable',
        ]);
        $category = new Category();
        $category->name= $request->name;
        $category->description= $request->fulldesc;
     //   $category->image= $request->imglink;
           if ($image = $request->file('image')) {
        $destinationPath = 'image/'; // Define the directory where you want to store the image

        // Generate a unique filename using current date/time and the original extension
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

        // Move the uploaded image to the destination folder
        $image->move($destinationPath, $profileImage);

        // Save the image filename (path) in the database
        $category->image = $destinationPath . $profileImage;
    }


        $category->status= $request->status;
        $result =  $category->save();

        return redirect()->route('Categorylist')
                ->with('success', 'Category created successfully!');

    }
    

   function editCategory($id)
    {
        $category = Category::findOrFail($id);
       
        return view('categories.category_edit', compact('category'));
    }

    function updateCategory(Request $request,$id)
    {
     
       $category = Category::find($id);
$category->update([
    'name' => $request->name,
    'description' => $request->description,
    'status' => $request->status,
    'image' => $request->image,
]);

        return response()->json(['success' => 'Category updated successfully']);
    }

    function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        
        return response()->json(['success' => 'Category deleted successfully']);
    }

    function categoryListData()
    {


        $listData = Category::all();

        return view('categories.category_form', ['listData'=>$listData]);
    }
    
}
