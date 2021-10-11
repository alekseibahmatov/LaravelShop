@extends('layouts.layout')

@section('title') Add Item @endsection

@section('main')
    <div class="container">
        <h1 class="mt-3 mb-3">Add item</h1>
        <form action="{{ route('shop.addItem') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Item title:</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Title" required>
            </div>
            <div class="form-group">
                <label for="desc">Description:</label>
                <textarea class="form-control" name="desc" id="desc" placeholder="Description" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" name="price" id="price" placeholder="Price" required>
            </div>
            <div class="input-group mt-4">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload image</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image" required>
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Add new item</button>
        </form>
    </div>
@endsection
