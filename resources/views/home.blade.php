@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col">
        <div class="row">
            <img src="https://wallpapercave.com/wp/wp10474800.jpg" style="max-width:100%; height:auto;" alt="cloud bg">
        </div>
        <div class="row mx-2 mt-4 p-2" style="background-color: lightblue;">
            <div class="col-12 text-center pt-2">
                <h1 class="text-white">CHOOSE YOUR JORNEY</h1>
            </div>
            <div class="form-group d-flex flex-wrap mt-3">
                @foreach($categories as $category)
                <div>
                    <div class="col-12 category-cell text-center pt-2">
                        <h5 class="text-white">{{ $category->name }}</h5>
                    </div>
                </div>
                @endforeach
            </div>

            <div>
                <hr>
            </div>
            
            <div class="row">
                <div class="form-group d-flex flex-wrap">
                    @foreach ($posters as $poster)
                    <div class="">
                        <div class="container">
                            <div class="card p-2 poster-card mb-2" style="width: 160px; height: 260px;">
                                <div class="row">
                                    <div class="col-12 text-center pt-2">
                                        <img style="height: 200px; width: 100%" src="{{ asset('storage/' . $poster->image_url) }}" alt="Poster Image">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center pt-2">
                                        <h6 class="poster-card-text">{{ $poster->title }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection