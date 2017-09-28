@extends('layouts.app')
@section('content')
    <h1>Items <a class='btn btn-success' href='/items/create'>Add more Items</a></h1>
    @if(count($data) > 0)
        @foreach($data as $item)
            <div class='well'>
                <h4><a href='/items/{{$item['id']}}'>{{$item['id']}} {{$item['type']}}</a></h4>
                <p>{{$item['brand']}}</p>
                <small>Item added on {{$item['created_at']}}</small>
            </div>
        @endforeach
    @else
        <p>No items found</p>
    @endif
@endsection