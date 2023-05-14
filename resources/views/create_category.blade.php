@extends('layouts.app')

@section('content')

<div class="container">
    <form action="/fuukaProject/public/api/V1/categories" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Category name:</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="description">Category description:</label>
            <input type="text" class="form-control" name="description" id="description" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Add Category</button>
        </div>

    </form>
</div>

@endsection