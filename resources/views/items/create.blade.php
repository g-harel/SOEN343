@extends('layouts.app')

@section('content')
    <a href="/items" class='btn btn-default'>Go Back</a>
    <h1>Create Items</h1>
        <div class="form-group">
            <h3 style="color:blue;">Type of Item</h1>
            <form name ="form1" method ="post" action ="radioButton.php">            <input type="radio" name="type" value="computer"> Telivision<br>
            <input type="radio" name="type" value="female"> Computer<br>
            </form
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