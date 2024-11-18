<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Division;
use App\Models\Facility;
use App\Models\Housing;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->orderByDesc('updated_at')->get();
        return view('categories.index', ['categories' => $categories]);
    }
    public function create()
    {
        $category_types = Category::where('parent_id', 1)->get();
        return view('categories.create', ['category_types' => $category_types]);
    }
    public function show(Category $category)
    {
        return view('categories.show', ['category' => $category]);
    }
    public function edit(Category $category)
    {
        $category_types = Category::where('parent_id', 1)->get();

        return view('categories.edit', ['category' => $category, 'category_types' => $category_types]);

    }
    public function store(Request $request)
    {
        try {
            $category = new Category();
            $category->label = $request->label;
            $category->parent_id = $request->parent_id;
            $category->save();
            return redirect('/category')->with('success', 'Category created successfully.');
        }
        catch (\Exception $e) {
            return redirect('/category')->with('error', $e->getMessage());
        }
    }
    public function update(Request $request, Category $category)
    {
        try {
            $request->validate([
                'label' => 'required|string|max:255',
                'parent_id' => 'nullable|exists:categories,id', // Ensure parent_id exists in the categories table
            ]);

            $category->label = $request->label;
            $category->parent_id = $request->parent_id;
            $category->save();
            return redirect('category')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            return redirect('/category/edit')->with('error',$e->getMessage());

        }


    }
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect('/category')->with('error', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect('/category')->with('warning', 'Failed to delete Category');
        }
    }




    // ........ Others Operation .........

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
