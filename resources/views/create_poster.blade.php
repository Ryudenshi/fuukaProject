@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">

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
                <button type="submit" class="btn btn-success">Add Poster</button>
            </div>
        </form>
    </div>

    <hr class="mt-4 mb-2">

    <div class="row">

        <div class="row my-4">
            <h3>Delete poster</h3>
        </div>

        @foreach($posters as $poster)
        <div class="col-4 mb-5">
            <div class="container">
                <div class="card p-2" style="max-height: 260px;">
                    <div>
                        <h4 class="ml-3 mt-2">{{ $poster->title }}</h4>
                    </div>
                    <div class="row">
                        <div class="col-6" style="max-height: 200px;">
                            <img class="mb-3" style="width: 100%" src="{{ asset('storage/' . $poster->image_url) }}" alt="Poster Image">
                        </div>
                        <div class="col-1"></div>
                        <div class="col-3">
                            <form action="/fuukaProject/public/api/V1/posters/{{ $poster->id }}" method="post" id="deletePosterForm">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="width: 120px;" class="btn btn-danger">Delete Poster</button>
                            </form>
                            <button type="button" style="width: 120px;" class="btn btn-primary mt-2" data-toggle="modal" data-target="#updatePosterModal{{ $poster->id }}">Update poster</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updatePosterModal{{ $poster->id }}" tabindex="-1" role="dialog" aria-labelledby="updatePosterModalLabel{{ $poster->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updatePosterModalLabel{{ $poster->id }}">Update Poster</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-6">
                            <img class="mb-3" style="width: 100%" src="{{ asset('storage/' . $poster->image_url) }}" alt="Poster Image">
                        </div>
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

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection