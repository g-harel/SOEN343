@extends('layouts.app')
@section('page-title')
    List of clients
@endsection
@section('content')
    @foreach($clients as $client)
        {{ $client->getEmail() }}
    @endforeach
@endsection