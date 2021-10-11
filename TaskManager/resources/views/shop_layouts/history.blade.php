@extends('layouts.layout')

@section('title') Buy History @endsection

@section('main')
    <div class="container mt-3">
        <h1 class="mb-3">History</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Item name</th>
                <th scope="col">Item price</th>
                <th scope="col">Item link</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $row)
                <tr>
                    <td>{{ $row->item->title }}</td>
                    <td>{{ $row->item->price }}</td>
                    <td><a href="{{ '/item/'.$row->item->id }}">Link</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
