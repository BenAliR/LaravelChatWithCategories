<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function generateUniqueSlug($title)
    {
        // Generate a base slug from the title
        $slug = Str::slug($title);

        // Check if the slug already exists in the database
        $count = Category::where('slug', $slug)->count();

        // If the slug exists, append a unique identifier
        if ($count > 0) {
            $slug = $slug . '-' . uniqid();
        }

        return $slug;
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::where('parent_id', null)->with('subcategories')->paginate(1);

        return view('dashboard.categories.index', [
            'categories' => $categories
        ]);
    }
    public function storeSubcategory(Request $request)
    {
        $request->validate([
            'parent_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $subcategory = new Category;
        $subcategory->parent_id = $request->parent_id;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->save();

        return redirect()->route('dashboard.categories.index')->with('success', 'Subcategory created successfully');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',

        ]);
     Category::create([
            'name' => $request->input('name'),
            'slug' => $this->generateUniqueSlug($request->input('name')),


        ]);

        return redirect('/dashboard/categories')->with('success', 'Une nouvelle catégorie a été ajoutée');
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|max:255',
        ];

        if ($request->slug != $category->slug){
            $rules['slug'] = 'required|unique:categories';
        }


      $request->validate($rules);
      $cateory =  Category::where('id', $category->id)->first();
        $cateory->name =   $request->input('name');
 $cateory->slug =  $this->generateUniqueSlug($request->input('name'));
 $cateory->save();
        return redirect('/dashboard/categories')->with('success', 'La catégorie a été mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return redirect('/dashboard/categories')->with('success', 'La catégorie a été supprimée');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
