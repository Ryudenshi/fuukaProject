<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PosterStoreRequest;
use App\Http\Resources\PosterResource;
use Illuminate\Http\Request;
use App\Models\Poster;
use App\Models\Category;

use Illuminate\Support\Facades\Storage;

class PosterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posters = Poster::with('categories')->get();

        return response()->json(PosterResource::collection($posters));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PosterStoreRequest $request)
    {

        if ($request->hasFile('image_url') && $request->file('image_url')->isValid()) {
            $imagePath = $request->file('image_url')->store('public/images');

            $imagePath = 'images/' . basename($imagePath);

            $categoryIds = $request->input('categories');

            $poster = new Poster();

            $poster->user_id = $request->input('user_id');
            $poster->title = $request->input('title');
            $poster->description = $request->input('description');
            $poster->image_url = $imagePath;
            $poster->price = $request->input('price');
            $poster->save();

            $poster->categories()->attach($categoryIds);

            return response()->json([
                'message' => 'Poster created successfully!',
                'data' => new PosterResource($poster),
            ]);
        }

        return response()->json([
            'message' => 'Invalid image file.',
        ], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Poster $poster)
    {
        return new PosterResource($poster);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'poster_category', 'poster_id', 'category_id');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PosterStoreRequest $request, $id, Poster $poster)
    {
        $poster = Poster::findOrFail($id);

        if ($poster) {
            $imagePath = $request->file('image_url')->store('public/images');

            $imagePath = 'images/' . basename($imagePath);

            $poster->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image_url' => $imagePath,
                'price' => $request->input('price'),
            ]);

            return response()->json([
                'message' => 'Poster updated successfully!',
                'data' => $poster
            ]);
        }

        return response()->json()([
            'message' => 'Failed to update...',
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poster $poster)
    {
        if ($poster) {
            $poster->delete();
            return redirect()->back()->with('success', 'Poster deleted successfully');
        }

        return redirect()->back()->with('error', 'Failed to delete poster');
    }
}
