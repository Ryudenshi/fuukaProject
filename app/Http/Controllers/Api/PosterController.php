<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PosterStoreRequest;
use App\Http\Resources\PosterResource;
use Illuminate\Http\Request;
use App\Models\Poster;
use Illuminate\Support\Facades\Storage;

class PosterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PosterResource::collection(Poster::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PosterStoreRequest $request)
    {

        if ($request->hasFile('image_url') && $request->file('image_url')->isValid())
        {
            $imagePath = $request->file('image_url')->store('public/images');

            $imagePath = 'images/' . basename($imagePath);

            $poster = new Poster();

            $poster->user_id = $request->input('user_id');
            $poster->title = $request->input('title');
            $poster->description = $request->input('description');
            $poster->image_url = $imagePath;
            $poster->price = $request->input('price');
            $poster->save();
        }

        return new PosterResource($poster);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new PosterResource(Poster::findOrFail($id)); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $poster = Poster::findOrFail($id);

        if ($poster) 
        {
            Storage::delete($poster->image);
            $poster->delete();
            return redirect()->back()->with('success', 'Poster deleted successfilly');
        }

        return redirect()->back()->with('error', 'Project not found');
    }
}
