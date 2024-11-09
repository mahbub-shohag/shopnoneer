<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Division;
use App\Models\Facility;
use App\Models\Housing;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all categories from the database
        $categories = Category::with('parent')->get();
        //echo "<pre>";print_r($categories);exit;
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category_types = Category::where('parent_id', 1)->get();
        return view('categories.create', ['category_types' => $category_types]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->label = $request->label;
        $category->parent_id = $request->parent_id;
        $category->save();

        // Redirect with success message
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }






    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Pass the single category to the 'categories.show' view
        return view('categories.show', ['category' => $category]);
    }
    public function edit(Category $category)
    {
        // Get only categories where parent_id is 1 for parent category selection
        $category_types = Category::where('parent_id', 1)->get();

        // Pass the category and the category_types to the edit view
        return view('categories.edit', ['category' => $category, 'category_types' => $category_types]);

    }


    public function update(Request $request, Category $category)
    {
        // Validate the incoming request (optional but recommended)
        $request->validate([
            'label' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id', // Ensure parent_id exists in the categories table
        ]);

        // Update the category with the new data
        $category->label = $request->label;
        $category->parent_id = $request->parent_id;
        $category->save();
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');


    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect('/category')->with('error', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect('/category')->with('warning', 'Failed to delete Housing');
        }
    }


    public function categoriesByCategoryId(Request $request)
    {
        $category_id = $request->category_id;
        $upazillas = Category::where('category_id', $category_id)->get();
        $options = "<option value='' SELECTED>Select Upazila</option>";

        foreach ($upazillas as $upazila) {
            $options = $options . "<option value='$upazila->id'>$upazila->name</option>";
        }
        return $options;
    }
}
