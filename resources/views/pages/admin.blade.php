@extends('layouts.app')

@section('content')
    <div class='jumbotron text-center'>
        @if(isset($_SESSION))
            {{ print_r($_SESSION) }}
            {{ $_SESSION['isAdmin'] }}

        @endif
        @if(!empty($session))
            {{ $session['isAdmin'] }}
            {{--print_r($session)--}}
            {{ 'he' }}
        @endif
        <h1>{{$title}} hello</h1>
        <p>Click the buttons below to view items currently in inventory or to add new items.</p>
        <p><a class='btn btn-primary btn-lg' href='/items/create' role='button'>Add</a> <a class='btn btn-success btn-lg' href="/items" id = 'view' role='button' >View</a>
    </div>
@endsection
