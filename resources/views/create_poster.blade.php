@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row border-bottom">

        <h3>Create poster</h3>

        <form action="/fuukaProject/public/api/V1/posters" method="post" enctype="multipart/form-data" id="createPoster">
            @csrf

            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="text" class="form-control" name="user_id" id="user_id" value="{{ auth()->user()->id }}" readonly>
            </div>

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" id="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="image_url">Image:</label>
                <input type="file" class="form-control-file" name="image_url" id="image_url" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" name="price" id="price" required>
            </div>

            <div class="form-group">
                <label for="categories">Categories:</label>
                <select class="form-control" name="categories[]" id="categories" multiple required>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add Poster</button>
            </div>
        </form>
    </div>

    <br>

    <div class="row  border-bottom p-4">

        <div class="col-6">

            <h3>Delete poster</h3>

            @foreach($posters as $poster)
            <div class="container">
                <div class="card">
                    <div>
                        <h4 class="ml-3 mt-2">{{ $poster->title }}</h4>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <img class="mb-3" style="width: 50%" src="{{ asset('storage/' . $poster->image_url) }}" alt="Poster Image">
                        </div>
                        <div class="col-3">
                            <form action="/fuukaProject/public/api/V1/posters/{{ $poster->id }}" method="post" id="deletePosterForm">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete Poster</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="col-6">

            <h3>Update poster</h3>

            @foreach($posters as $poster)
            <div class="container">
                <div class="card">
                    <div>
                        <h4 class="ml-3 mt-2">{{ $poster->title }}</h4>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <img class="mb-3" style="width: 50%" src="{{ asset('storage/' . $poster->image_url) }}" alt="Poster Image">
                        </div>
                        <div class="col-3">
                            <form action="/fuukaProject/public/api/V1/posters/{{ $poster->id }}" method="post" enctype="multipart/form-data" id="updatePoster">
                                @csrf
                                @method('PUT')

                                <p>{{ $poster->id }}</p>

                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" class="form-control" name="title" id="title" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" name="description" id="description" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="image_url">Image:</label>
                                    <input type="file" class="form-control-file" name="image_url" id="image_url" accept="image/*" required>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input type="number" class="form-control" name="price" id="price" required>
                                </div>

                                <div class="form-group">
                                    <label for="categories">Categories:</label>
                                    <select class="form-control" name="categories[]" id="categories" multiple required>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>



</div>

@endsection