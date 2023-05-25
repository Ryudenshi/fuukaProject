@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">

        <h3>Create poster</h3>

        <form onsubmit="event.preventDefault(); createPoster();" id="createPoster" action="/fuukaProject/public/api/V1/posters" method="post" enctype="multipart/form-data" id="createPoster">
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
                <label for="date">Release date:</label>
                <input type="text" class="form-control" name="date" id="date" required>
            </div>

            <div class="form-group">
                <label for="categories">Categories:</label>
                <div class="form-group d-flex flex-wrap">
                    @foreach($categories as $category)
                    <div class="form-check mx-2">
                        <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category{{ $category->id }}">
                        <label class="form-check-label" for="category{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <button onsubmit="event.preventDefault(); createPoster();" type="submit" class="btn btn-success">Add Poster</button>
            </div>
        </form>
    </div>

    <hr class="mt-4 mb-2">

    <div class="row">

        <div class="row my-4">
            <h3>Poster list</h3>
        </div>

        @foreach($posters as $poster)
        <div class="col-4 mb-5">
            <div class="container">
                <div class="card p-2" style="max-height: 3000px;">
                    <div>
                        <h4 class="ml-3 mt-2 poster-delete-card">{{ $poster->title }}</h4>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a class="posterRedirection" href="{{ route('poster.show', ['poster' => $poster->id]) }}">
                                <img class="mb-3 ml-3" style="height: 200px; width: auto" src="{{ asset('storage/' . $poster->image_url) }}" alt="Poster Image">
                            </a>
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
                    <div class="row">
                        <p class="ml-3">Press on the image to redirect on the title page...</p>
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
                        <form action="/fuukaProject/public/api/V1/posters/{{ $poster->id }}" method="post" enctype="multipart/form-data" id="updatePosterForm{{ $poster->id }}">
                            @csrf
                            @method('PUT')

                            <span>Category ID: </span><span>{{ $poster->id }}</span>

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" value="{{ $poster->title }}" name="title" id="title" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" name="description" id="description" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="image_url">Image:</label>
                                <input type="file" class="form-control-file" name="image_url" id="image_url" accept="image/*">
                            </div>

                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" class="form-control" value="{{ $poster->price }}" name="price" id="price" required>
                            </div>

                            <div class="form-group">
                                <label for="categories">Categories:</label>
                                @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category{{ $category->id }}">
                                    <label class="form-check-label" for="category{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                                @endforeach
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

<script>
    function createPoster() {
        var form = document.getElementById('createPoster');
        var formData = new FormData(form);

        fetch('/fuukaProject/public/api/V1/posters', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response data
                console.log(data);
                if (data.message === 'Poster created successfully!') {
                    // Show the success modal
                    $('#successModal').modal('show');
                } else {
                    // Show an error message
                    $('#errorModal').modal('show');
                }
            })
            .catch(error => {
                // Handle any errors
                console.error(error);
                $('#errorModal').modal('show');
            });
    }
</script>

@endsection