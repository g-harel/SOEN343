@extends('layouts.app')
@section('content')


<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-12 col-sm-9">
        <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
        </p>
        @if(empty($id))
        <div class="row">
            <div class="col-lg-12">
               <h1> <small>Here are some weekly hot sellers!</small></h1>
            </div>
            <div class="col-xs-6 col-lg-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Razr Laptop</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <i class="fa fa-laptop fa-5x"></i>
                            </div>
                            <div class="col-md-6">
                                <p >Price: $199.99</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                            <p>Item Info</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span><a class="btn btn-default" href="/view/laptop/1" role="button">View details »</a></span>
                        <span><a class="btn btn-default" href="#" role="button">Add to Cart »</a></span>
                    </div>
                </div>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Razr Laptop</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <i class="fa fa-laptop fa-5x"></i>
                            </div>
                            <div class="col-md-6">
                                <p >Price: $199.99</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <p>Item Info</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span><a class="btn btn-default" href="/view/laptop/1" role="button">View details »</a></span>
                        <span><a class="btn btn-default" href="#" role="button">Add to Cart »</a></span>
                    </div>
                </div>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Razr Laptop</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <i class="fa fa-laptop fa-5x"></i>
                            </div>
                            <div class="col-md-6">
                                <p >Price: $199.99</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <p>Item Info</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span><a class="btn btn-default" href="/view/laptop/1" role="button">View details »</a></span>
                        <span><a class="btn btn-default" href="#" role="button">Add to Cart »</a></span>
                    </div>
                </div>
            </div><!--/.col-xs-6.col-lg-4-->
        </div><!--/row-->
        @else
            <div class="col-xs-12 col-lg-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Razr Monitor</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <i class="fa fa-laptop fa-5x"></i>
                            </div>
                            <div class="col-md-8">
                                <p>Price: $199.99</p>
                                <p>Brand: Samsung</p>
                                <p>quantity: 2</p>
                                <p>Brand: Samsung</p>
                                <p>Camera: Yes</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span><a class="btn btn-default" href="#" role="button">Add to Cart »</a></span>
                    </div>
                </div>
            </div><!--/.col-xs-6.col-lg-4-->
        @endif
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