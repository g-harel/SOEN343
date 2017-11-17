@extends('layouts.app')
@section('content')

<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-12 col-sm-9">
        <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
        </p>
        @if(Session::has('notFound'))
            <div class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <label>Monitor not found.</label>
            </div>
        @endif
        @if(!empty($noResults))
            <div class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>No results were found for your search.</p>
            </div>
        @endif
        @if(!empty($numResult))
            <div class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <label>{{$numResult}} result(s) found.</label>
            </div>
        @endif
        @if(!empty($result))
            @foreach($result as $value)
                <div class="row">
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
                                        <p>Price: <b> ${{$value['price']}}</b> </p>
                                        <p>Brand: <b>{{$value['brand']}}</b> </p>
                                        <p>Quantity: <b>{{$value['quantity']}}</b> </p>
                                        <p>Display Size: <b>{{$value['display_size']}} inches</b> </p>
                                        <p>Weight: <b>{{$value['weight']}} kg</b> </p>
                                            <p>Serial #: <b>{{$value['serial']}} </b> </p>
                                    </div>
                                </div>
                            </div>
                            <form method="post" action="items/monitor/reserve">
                            <div class="panel-footer">
                                <input type="hidden" name="serial" value="{{$value['serial']}}">
                                <span><input class="btn btn-default" role="submit" value="Add to Cart"></span>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        @if(empty($details) && empty($result))
        <div class="row">
        @foreach($monitors as $monitor)
            <div class="col-xs-6 col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">"{{$monitor['display_size']}}  {{$monitor['brand']}} Monitor</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <i class="fa fa-television fa-5x"></i>
                            </div>
                            <div class="col-md-6">
                                <p>Price: ${{$monitor['price']}}</p>
                                <p>Serial #: {{$monitor['serial']}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span><a class="btn btn-default" href="/view/monitor/{{$monitor['id']}}" role="button">View details »</a></span>
                        <form method="post" action="items/monitor/reserve">
                            {{ csrf_field() }}
                            <div class="panel-footer">
                                <input type="hidden" name="serial" value="{{$monitor['serial']}}">
                                <input type="hidden" name="brand" value="{{$monitor['brand']}}">
                                <input type="hidden" name="display_size" value="{{$monitor['display_size']}}">
                                <input type="hidden" name="price" value="{{$monitor['price']}}">
                                <input type="hidden" name="monitor-id" value="{{$monitor['id']}}">
                                <span><input class="btn btn-default" type="submit" value="Add to Cart"></span>
                            </div>
                        </form>
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
                                <p>Price:<b> ${{$details['price']}}</b> </p>
                                <p>Brand: <b>{{$details['brand']}}</b> </p>
                                <p>Quantity: <b>{{$details['quantity']}}</b> </p>
                                <p>Display Size: <b>{{$details['display_size']}} inches</b> </p>
                                <p>Weight: <b>{{$details['weight']}} kg</b> </p>
                                <p>Serial #: <b>{{$details['serial']}} </b> </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span><a class="btn btn-default" href="" role="button">Add to Cart »</a></span>
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
                <form id="monitor-form" class="form-horizontal" action="/view/monitor/search" method="get">
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
                            <button type="submit" class="btn btn-success btn-sm" name="client-search-monitor-form" id="client-search-monitor-form">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!--/.sidebar-offcanvas-->
</div>

    @endsection