@extends('layouts.layout')

@section('title') Item {{ $item->id }} @endsection

@section('main')
    <div class="container mt-3">
        <h1>Item description</h1>
        <div class="row justify-content-between">
            <div class="col-5 mt-3">
                <img src="{{ '../images/'.$item->image }}" width="100%" alt="Image">
            </div>
            <div class="col-7">
                <h2 class="text-left">{{ $item->title }}</h2>
                <p class="text-justify mt-3">{{ $item->desc }}</p>
                <h5 class="text-right">Price: {{ $item->price }}$ <a class="btn btn-primary" href="{{'/buyItem/'.$item->id}}">Buy</a></h5>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>Comments</h2>
        <ul class="list-group list-group-flush">
            @foreach($comments as $comment)
                <li class="list-group-item">
                    <h5>{{ $comment->title }}</h5>
                    <p>{{ $comment->comment }}</p>
                    <div class="row">
                        <div class="col-6">
                            <p>Created: {{ $comment->created_at }}</p>
                        </div>
                        <div class="col-6">
                            <p class="text-right">{{ 'Author: '.$comment->user->firstname.' '.$comment->user->lastname }}</p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        @if(auth()->check())
            <form action="{{ route('shop.addComment', $item->id) }}" method="post" class="mt-3 mb-3">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title" required>
                </div>
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea name="comment" id="comment" class="form-control" placeholder="Comment" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Comment</button>
            </form>
        @endif
    </div>
@endsection
