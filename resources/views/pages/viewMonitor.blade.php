@extends('layouts.app')
@section('content')


<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-12 col-sm-9">
        <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
        </p>
        <div class="row">
            <div class="col-lg-12">
               <h1> <small>Here are some weekly hot sellers!</small></h1>
            </div>
            <div class="col-xs-6 col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dell Monitor</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <i class="fa fa-television fa-5x"></i>
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
                        <span><a class="btn btn-default" href="#" role="button">View details »</a></span>
                        <span><a class="btn btn-default" href="#" role="button">Add to Cart »</a></span>
                    </div>
                </div>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dell Monitor</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <i class="fa fa-television fa-5x"></i>
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
                        <span><a class="btn btn-default" href="#" role="button">View details »</a></span>
                        <span><a class="btn btn-default" href="#" role="button">Add to Cart »</a></span>
                    </div>
                </div>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dell Monitor</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <i class="fa fa-television fa-5x"></i>
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
                        <span><a class="btn btn-default" href="#" role="button">View details »</a></span>
                        <span><a class="btn btn-default" href="#" role="button">Add to Cart »</a></span>
                    </div>
                </div>
            </div><!--/.col-xs-6.col-lg-4-->
        </div><!--/row-->
    </div><!--/.col-xs-12.col-sm-9-->

    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
        <div class="list-group">
            <a href="/view/monitor" class="list-group-item active">Monitor</a>
            <a href="/view/desktop" class="list-group-item">Desktop</a>
            <a href="/view/laptop" class="list-group-item">Laptop</a>
            <a href="/view/tablet" class="list-group-item">Tablet</a>
        </div>
        <!-- advanced search -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Advanced Search</h3>
            </div>
            <div class="panel-body">
                <form id="monitor-form" class="form-horizontal" action="" method="post">
                    <div class="col-md-12">
                        <div class="form-group">
                            Brand Name:
                            <select name="monitor-brand" id="monitor-brand" class="form-control" required="">
                                <option title="Select brands" value="">Select Brand</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Display size (inches):
                            <select name="monitor-display-size" id="monitor-display-size" class="form-control" required="">
                                <option title="Select display size" value="">Select display size</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Price: <br>
                            min:<input type="number" min="1" step="0.01" placeholder="0.00" max="99999" name="monitor-price" id="monitor-price" class="form-control">
                            max:<input type="number" min="1" step="0.01" placeholder="0.00" max="99999" name="monitor-price" id="monitor-price" class="form-control" >
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm" name="submit-monitor-form" id="submit-monitor-form">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!--/.sidebar-offcanvas-->
</div>

    @endsection