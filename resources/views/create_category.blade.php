@extends('layouts.app')

@section('content')

<div class="container">
    <h3>Create category</h3>

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
            <button type="submit" class="btn btn-success">Add Category</button>
        </div>

    </form>

    <hr class="my-4">

    <div class="row">
        <h3 class="mx-auto">Category list</h3>
    </div>

    <div class="row">
        @foreach($categories as $category)
        <div class="col-4 mb-5">
            <div class="container">
                <div class="card p-2">
                    <div class="row">
                        <div class="col-7">
                            <h4 class="ml-3 mt-4">{{ $category->name }}</h4>
                        </div>

                        <div class="col-3">
                            <form action="/fuukaProject/public/api/V1/categories/{{ $category->id }}" method="post" id="deleteCategoryForm">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete category</button>
                            </form>
                            <button type="button" style="width: 130px;" class="btn btn-primary mt-2" data-toggle="modal" data-target="#updateCategoryModal{{ $category->id }}">Update category</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Update Category Modal -->
        <div class="modal fade" id="updateCategoryModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="updateCategoryModalLabel{{ $category->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateCategoryModalLabel{{ $category->id }}">Update Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/fuukaProject/public/api/V1/categories/{{ $category->id }}" method="post" enctype="multipart/form-data" id="updateCategoryForm{{ $category->id }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" id="name{{ $category->id }}" value="{{ $category->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" name="description" id="description{{ $category->id }}" required>{{ $category->description }}</textarea>
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
        <!-- End Update Category Modal -->

        @endforeach
    </div>
</div>
@endsection