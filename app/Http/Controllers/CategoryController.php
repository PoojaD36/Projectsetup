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
            'imglink' => 'nullable|url'
        ]);
        $category = new Category();
        $category->name= $request->name;
        $category->description= $request->fulldesc;
        $category->image= $request->imglink;
        $result =  $category->save();

    }
    

   function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $validated = $request->validate([
            'tag' => 'required|unique:categories,tag,'.$id,
            'name' => 'required',
            'shortdesc' => 'required',
            'fulldesc' => 'nullable',
            'imglink' => 'nullable|url'
        ]);

        $category->update($validated);

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
//$id_value = Session::get('login_id');

        $listData = Category::all();

        return view('categories.category_form', ['listData'=>$listData]);
    }
    
}
