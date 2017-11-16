@extends('layouts.app')
@section('page-title')
    Browse Products
@endsection
@section('content')
<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-12 col-sm-9">
        <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
        </p>
        <div class="jumbotron">
            <h1>Hello, dear user!</h1>
            <p>You may select an item category using the links on the side</p>
        </div>
        <div class="row">
        </div><!--/row-->
    </div><!--/.col-xs-12.col-sm-9-->
    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
        <div class="list-group">
            <a href="/view/monitor" class="list-group-item">Monitor</a>
            <a href="/view/desktop" class="list-group-item">Desktop</a>
            <a href="/view/laptop" class="list-group-item">Laptop</a>
            <a href="/view/tablet" class="list-group-item">Tablet</a>
        </div>
    </div><!--/.sidebar-offcanvas-->
</div>

    @endsection