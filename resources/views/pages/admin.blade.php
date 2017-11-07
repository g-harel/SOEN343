@extends('layouts.app')

@section('content')
    <div class='jumbotron text-center'>
        <h1>Welcome to the Admin page</h1>
        <p>Click the buttons below to view items currently in inventory or to add new items.</p>
        <p><a class='btn btn-primary btn-lg' href='/items/create' role='button'>Add</a> <a class='btn btn-success btn-lg' href="/items" id = 'view' role='button' >View</a>
    </div>
@endsection
