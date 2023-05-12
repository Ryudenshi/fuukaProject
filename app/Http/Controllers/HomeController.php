<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\CategoryController;
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
    public function index(CategoryController $categoryController)
    {
        $response = $categoryController->index();
        $categories = $response->getData();

        return view('home', ['categories' => $categories]);
    }
}
