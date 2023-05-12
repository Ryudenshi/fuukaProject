<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PosterResource;
use App\Models\Category;
use App\Models\Poster;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategoryResource::collection(Category::all());

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {

        $category = new Category();

        $category->name = $request->input('name');
        $category->description = $request->input('description');

        $category->save();

        return response()->json([
            'message' => 'Category created successfully!',
            'data' => $category,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new CategoryResource($category); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryStoreRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return response()->json([
            'message' => 'Category updated successfully!',
            'data' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->noContent();
    }
}
