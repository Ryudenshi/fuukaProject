@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/fuukaProject/public/api/V1/posters" method="post" enctype="multipart/form-data">
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



<script>
    $(document).ready(function() {
        // Handle form submission
        $('#yourFormId').submit(function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '/api/V1/posters',
                method: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    // Show the success message in a modal
                    $('#successModal .message').text(response.message);
                    $('#successModal').show();
                },
                error: function(xhr, status, error) {
                    // Handle the error case
                }
            });
        });
    });
</script>

@endsection