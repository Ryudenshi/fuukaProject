@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (!empty($categories))
        @foreach($categories as $category)
        <div>
            <h3>{{ ($category->name) }}</h3>
            <p>{{ ($category->description) }}</p>
        </div>
        @endforeach
        @else
        <p>No categories found.</p>
        @endif
    </div>
    <div class="row justify-content-center">
        @if (!empty($posters))
        @foreach($posters as $poster)
        <div>
            <h3>{{ ($poster->title) }}</h3>
            <p>{{ ($poster->description) }}</p>
        </div>
        @endforeach
        @else
        <p>No categories found.</p>
        @endif
    </div>
</div>

@endsection