<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PosterController;
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
        $categoriesResponce = $categoryController->index();
        $postersResponce =$posterController->index();

        $categories = $categoriesResponce->getData();
        $posters = $postersResponce->getData();

        return view('home', ['categories' => $categories], ['posters' => $posters]);
    }
}
