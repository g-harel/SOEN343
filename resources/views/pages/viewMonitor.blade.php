@extends('layouts.app')
@section('content')

<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-12 col-sm-9">
        <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
        </p>
        @if(!empty($result))
            @foreach($result as $value)
                <div class="row">
                    @if(!empty($numResult))
                        <div class="col-md-6">
                            <label>{{$numResult}} result(s) found.</label>
                        </div>
                    @endif
                    <div class="col-xs-12 col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{$value['brand']}} Monitor</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <i class="fa fa-television fa-5x"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <p>Price:<strong> ${{$value['price']}}</strong> </p>
                                        <p>Brand: <strong>{{$value['brand']}}</strong> </p>
                                        <p>Quantity: <strong>{{$value['quantity']}}</strong> </p>
                                        <p>Display Size: <strong>{{$value['displaySize']}} inches</strong> </p>
                                        <p>Weight: <strong>{{$value['weight']}} kg</strong> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <span><a class="btn btn-default" href="#" role="button">Add to Cart »</a></span>
                            </div>
                        </div>
                    </div><!--/.col-xs-6.col-lg-4-->
                </div>
            @endforeach
        @endif
        @if(empty($details) && empty($result))
        <div class="row">
        @foreach($monitors as $monitor)
            <div class="col-xs-6 col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">"{{$monitor['displaySize']}}  {{$monitor['brand']}} Monitor</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <i class="fa fa-television fa-5x"></i>
                            </div>
                            <div class="col-md-6">
                                <p  >Price: ${{$monitor['price']}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span><a class="btn btn-default" href="/view/monitor/{{$monitor['id']}}" role="button">View details »</a></span>
                        <span><a class="btn btn-default" href="#" role="button">Add to Cart »</a></span>
                    </div>
                </div>
            </div><!--/.col-xs-6.col-lg-4-->
        @endforeach
    </div><!--/row-->
        @endif
        @if(!empty($details))
            <div class="row">
            <div class="col-xs-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$details['brand']}} Monitor</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <i class="fa fa-television fa-5x"></i>
                            </div>
                            <div class="col-md-8">
                                <p>Price:<strong> ${{$details['price']}}</strong> </p>
                                <p>Brand: <strong>{{$details['brand']}}</strong> </p>
                                <p>Quantity: <strong>{{$details['quantity']}}</strong> </p>
                                <p>Display Size: <strong>{{$details['displaySize']}} inches</strong> </p>
                                <p>Weight: <strong>{{$details['weight']}} kg</strong> </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span><a class="btn btn-default" href="#" role="button">Add to Cart »</a></span>
                    </div>
                </div>
            </div><!--/.col-xs-6.col-lg-4-->
            </div>
        @endif
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
                <form id="monitor-form" class="form-horizontal" action="/items/monitor/search" method="get">
                    <div class="col-md-12">
                        <div class="form-group">
                            Brand Name:
                            <select name="monitor-brand" id="monitor-brand" class="form-control" >
                                <option title="Select brands" value="">Select Brand</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Display size (inches):
                            <select name="monitor-display-size" id="monitor-display-size" class="form-control" >
                                <option title="Select display size" value="">Select display size</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Price: <br>
                            min:<input type="number" step="0.01" placeholder="0.00" max="99999" name="min-price" id="monitor-price" class="form-control" value="0">
                            max:<input type="number" step="0.01" placeholder="0.00" max="99999" name="max-price" id="monitor-price" class="form-control" value="0">
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