<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();

        return view('admins.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        // Create the category
        $category = Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories.index')
        ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //return view('admins.edit_category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
       /* $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);
    
        // Update the category
        $category->update([
            'name' => $request->name,
        ]);
    
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
   */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */

     public function destroy(Category $category)
     {
         // Check if the category is associated with any job listings
         if ($category->jobListings()->exists()) {
             return redirect()->back()->with('error', 'Cannot delete category as it is associated with some job listings.');
         }
     
         // Delete the category
         $category->delete();
     
         return redirect()->back()->with('success', 'Category deleted successfully.');
     }
     
}
