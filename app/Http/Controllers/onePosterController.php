<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\PosterController;
use App\Http\Controllers\Controller;
use App\Models\Poster;
use Illuminate\Http\Request;

class onePosterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryController $categoryController, PosterController $posterController)
    {
        $categoriesResponse = $categoryController->index();
        $postersResponse = $posterController->index();

        $categories = $categoriesResponse->getData();

        $postersData = $postersResponse->getData();
        $posters = Poster::hydrate($postersData);

        return view('home', compact('categories', 'posters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $poster = Poster::find($id);

        return view('poster', compact('poster'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
    }
}
