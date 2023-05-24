@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-12">
        <div class="row poster-info justify-content-between p-3">
            <div class="col">
                <h4 class="mt-2 anime-info">ANIME INFO</h4>
            </div>
            <div class="col-1 d-flex inline-block logo-on-poster-page">
                <h2 class=" logo-text-main text-white">FuuKA</h2>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-4">
                <img style=" width: 100%" src="{{ asset('storage/' . $poster->image_url) }}" alt="Poster Image">
            </div>
            <div class="col-7">
                <div class="row">
                    <h3 class="mt-2 ml-2 anime-text">{{ $poster->title }}</h3>
                </div>
                <div class="row mt-2">
                    <div class="col-12 ml-2">
                        <span class="anime-text">Plot Summary: </span>
                        <span>{{ $poster->description }}</span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 ml-2">
                        <span class="anime-text">Genre: </span>
                        <span>
                            @foreach ($poster->categories as $category)
                            {{ $category->name }}
                            @if (!$loop->last)
                            ,
                            @endif
                            @endforeach
                        </span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 ml-2">
                        <span class="anime-text">Release date: </span>
                        <span>{{ $poster->date }}</span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3 ml-2 d-flex inline-block justify-content-between">
                        <h4 class="anime-text">PRICE:</h4><h4>{{ $poster->price }}₴</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection