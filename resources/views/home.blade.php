@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col">
        <div class="row">
            <img src="https://wallpapercave.com/wp/wp10474800.jpg" style="max-width:100%; height:auto;" alt="cloud bg">
        </div>
        <div class="row mx-2 mt-4 p-2" style="background-color: lightblue;">
            <div class="col-12 text-center pt-2">
                <h1 class="text-white">CHOOSE YOUR JOURNEY</h1>
            </div>

            <div class="row"><label class="text-white">Select Categories:</label></div>
            <div class="form-group d-flex flex-wrap ">
                @foreach ($categories as $category)
                <div class="form-check mx-2">
                    <input class="form-check-input category-checkbox" type="checkbox" value="{{ $category->id }}" id="category-{{ $category->id }}">
                    <label class="form-check-label" for="category-{{ $category->id }}">
                        {{ $category->name }}
                    </label>
                </div>
                @endforeach
            </div>

            <div>
                <hr>
            </div>

            <div class="row">
                <div class="form-group d-flex flex-wrap ml-5">
                    @foreach ($posters as $poster)
                    <a class="posterRedirection" href="{{ route('poster.show', ['poster' => $poster->id]) }}">
                        <div class="poster-card-container" data-categories="{{ $poster->categories->pluck('id')->toJson() }}">
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
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.category-checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const selectedCategories = Array.from(document.querySelectorAll('.category-checkbox:checked'), checkbox => checkbox.value);
            const posterCardContainers = document.querySelectorAll('.poster-card-container');

            posterCardContainers.forEach(function(container) {
                const categories = JSON.parse(container.dataset.categories);

                if (selectedCategories.length === 0 || selectedCategories.every(categoryId => categories.includes(parseInt(categoryId)))) {
                    container.style.display = 'block';
                } else {
                    container.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection