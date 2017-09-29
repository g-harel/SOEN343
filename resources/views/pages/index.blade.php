@extends('layouts.app')

@section('content')
    <?php

        include_once(__DIR__ . "/../../../database/gateway/ItemGateway.php");

        $g = new ItemGateway("desktops", array("computers"));
        $r = $g->getById(1);

        echo '<pre>'; print_r($r); echo '</pre>';

    ?>
    <div class='jumbotron text-center'>
        <h1>{{$title}}</h1>
        <p>This is our new home page</p>
        <p><a class='btn btn-primary btn-lg' href='/login' role='button'>Login</a> <a class='btn btn-success btn-lg' href='/register' role='button'>Register</a>
    </div>
@endsection