<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('subcategories')->leftjoin('categories', 'subcategories.category_id', 'categories.id')->select('subcategories.*', 'categories.category_name')->get();
        $category = Category::all();
        return view('admin.category.subcategory.index', compact('data', 'category'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subcategory_name' => 'required|max:55',
        ]);

        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name, '-')
        ]);

        $notification = array('message' => 'Subcategory Inserted', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $data = Subcategory::find($id);
        $category = Category::all();

        return view('admin.category.subcategory.edit', compact('data', 'category'));
    }

    public function update(Request $request)
    {
        $subcategory = Subcategory::find($request->id);
        $subcategory->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name, '-')
        ]);

        $notification = array('message' => 'Category Updated', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function delete($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();

        $notification = array('message' => 'Sub Category Deleted', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
