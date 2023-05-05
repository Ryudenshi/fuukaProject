<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poster;

class PosterController extends Controller
{
    public function index()
    {
        return Poster::all();
    }
}
