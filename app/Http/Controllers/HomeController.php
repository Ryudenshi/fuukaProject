<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\PosterController;
use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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
}
