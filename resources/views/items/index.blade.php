@extends('layouts.app')

@section('content')
    @if(count($items) > 0)
        @foreach($items as $item)
            <div class='well'>
                <h4><a href='items/{{$item->id}}'>{{$item->id}} {{$item->type}}</a></h4>
                <p>{{$item->brand}}</p>
                <small>Item added on {{$item->created_at}}</small>
            </div>
        @endforeach
    @else
        <p>No items found</p>
    @endif
@endsection