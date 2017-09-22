@extends('layouts.app')

@section('content')
    <a href="/items" class='btn btn-default'>Go Back</a>
    <h1>Create Items</h1>
    {!! Form::open(['action' => 'ItemsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('brand', 'Brand')}}
            {{Form::text('brand', '', ['class' => 'form-control', 'placeholder' => 'Brand'])}}
        </div>
        <div class="form-group">
            {{Form::label('price', 'Price')}}
            {{Form::text('price', '', ['class' => 'form-control', 'placeholder' => 'Price'])}}
        </div>
        <div class="form-group">
            {{Form::label('type', 'Type')}}
            {{Form::text('type', '', ['class' => 'form-control', 'placeholder' => 'TV, Computer, Monitor'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection