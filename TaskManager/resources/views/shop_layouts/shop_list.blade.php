@extends('layouts.layout')

@section('title') Items list @endsection

@section('main')
    <div class="container">
        <h1 class="mt-3 mb-5">Item list</h1>
        @foreach($data as $row)
        <div class="row">
            @foreach($row as $item)
            <div class="col-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{'images/'.$item->image}}" alt="Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ $item->short_desc }}</p>
                        <h5>{{ $item->price }}$</h5>
                        <a href="{{'/item/'.$item->id}}" class="btn btn-primary me-auto">Buy</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
@endsection
