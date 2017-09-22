@extends('layouts.app')

@section('content')
    <a href="/items" class='btn btn-default'>Go Back</a>
    <h1>{{$item->id}} {{$item->brand}}</h1>
    <small>Item added on {{$item->created_at}}</small>
    <div>
        <p>Price: {{$item->price}}$</p>
    </div>
@endsection