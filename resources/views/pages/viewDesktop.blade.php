@extends('layouts.app')
@section('content')


<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-12 col-sm-9">
        <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
        </p>
        @if(Session::has('unitNotReserved'))
            <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>You need to be logged in to add to cart!</p>
            </div>
        @endif
        @if(Session::has('unitReserved'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>Units were successfully added to your Shopping Cart</p>
            </div>
        @endif
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
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{$value['brand']}} Desktop</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <i class="fa fa-desktop fa-5x"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <p>Price: <b>${{$value['price']}}</b> </p>
                                        <p>Brand: <b>{{$value['brand']}}</b> </p>
                                        <p>Processor Type: <b>{{$value['processorType']}} </b> </p>
                                        <p>Ram Size: <b>{{$value['ramSize']}} GB</b> </p>
                                        <p>CPU Cores: <b>{{$value['cpuCores']}} </b> </p>
                                        <p>Hard Disk Size: <b>{{$value['hddSize']}} GB</b> </p>
                                        <p>Height: <b>{{$value['height']}} cm</b> </p>
                                        <p>Width: <b>{{$value['width']}} cm</b> </p>
                                        <p>Thickness: <b>{{$value['thickness']}} cm</b> </p>
                                        <p>Weight: <b>{{$value['weight']}} kg</b> </p>
                                        <p>Model #: <b>{{$value['model']}} </b> </p>
                                        <p>Serial #: <b>{{$value['serial']}} </b> </p>
                                    </div>
                                </div>
                            </div>
                                <div class="panel-footer">
                                    <span><a class="btn btn-default" href="/view/desktop/{{$value['id']}}/{{$value['serial']}}" role="button">View details »</a></span>
                                </div>
                        </div>
                    </div><!--/.col-xs-6.col-lg-4-->
                </div>
            @endforeach
        @endif
        @if(empty($desktops) && empty($details) && empty($result))
            <p>Desktop item catalog is currently empty.</p>
        @endif
        @if(empty($details) && empty($result))
        <div class="row">
            @foreach($desktops as $desktop)
                <div class="col-xs-6 col-lg-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title"> {{$desktop['brand']}} Desktop</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <i class="fa fa-desktop fa-5x"></i>
                                </div>
                                <div class="col-md-6">
                                    <p>Price: ${{$desktop['price']}}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <ul class="list-group">
                                        <li>Processor Type: <b>{{$desktop['processorType']}}</b></li>
                                        <li>Ram Size: <b>{{$desktop['ramSize']}} GB</b></li>
                                        <li>CPU Cores: <b>{{$desktop['cpuCores']}}</b></li>
                                        <li>Hard Disk Size: <b>{{$desktop['hddSize']}} GB</b></li>
                                        <li>Model #: <b>{{$desktop['model']}}</b></li>
                                        <li>Serial #: <b>{{$desktop['serial']}}</b></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <form method="post" action="items/desktop/reserve">
                                <span><input class="btn btn-default" type="submit" role="submit" value="Add to Cart"></span>
                                <span><a class="btn btn-default" href="/view/desktop/{{$desktop['id']}}/{{$desktop['serial']}}" role="button">View details »</a></span>
                                <input type="hidden" name="serial" value="{{$desktop['serial']}}">
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
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{$details['brand']}} Desktop</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <i class="fa fa-desktop fa-5x"></i>
                                </div>
                                <div class="col-md-8">
                                    <p>Price: <b>${{$details['price']}}</b> </p>
                                    <p>Brand: <b>{{$details['brand']}}</b> </p>
                                    <p>Processor Type: <b>{{$details['processorType']}} </b> </p>
                                    <p>Ram Size: <b>{{$details['ramSize']}} GB</b> </p>
                                    <p>CPU Cores: <b>{{$details['cpuCores']}} </b> </p>
                                    <p>Hard Disk Size: <b>{{$details['hddSize']}} GB</b> </p>
                                    <p>Height: <b>{{$details['height']}} cm</b> </p>
                                    <p>Width: <b>{{$details['width']}} cm</b> </p>
                                    <p>Thickness: <b>{{$details['thickness']}} cm</b> </p>
                                    <p>Weight: <b>{{$details['weight']}} kg</b> </p>
                                    <p>Model #: <b>{{$details['model']}} kg</b> </p>
                                    <p>Serial #: <b>{{$details['serial']}}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.col-xs-6.col-lg-4-->
            </div>
        @endif
    </div><!--/.col-xs-12.col-sm-9-->

    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
        <div class="list-group">
            <a href="/view/monitor" class="list-group-item">Monitor</a>
            <a href="/view/desktop" class="list-group-item active">Desktop</a>
            <a href="/view/laptop" class="list-group-item">Laptop</a>
            <a href="/view/tablet" class="list-group-item">Tablet</a>
        </div>
        <!-- advanced search -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Advanced Search</h3>
            </div>
            <div class="panel-body">
                <form id="desktop-form" class="form-horizontal" action="/view/computer/search" method="GET">
                    <div class="col-md-12">
                        <div class="form-group">
                            Brand:
                            <select  name="desktop-brand" id="desktop-brand" class="form-control">
                                <option title="Select brands" value="">Select brands</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Hard Drive Size (GB):
                            <select  name="desktop-storage-capacity" id="desktop-storage-capacity" class="form-control">
                                <option title="Select storage qty" value="">Select storage size</option>
                            </select>
                        </div>

                        <div class="form-group">
                            Ram Size (GB):
                            <select  name="desktop-ram-size" id="desktop-ram-size" class="form-control">
                                <option title="Select desktop ram size" value="">Select ram size</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Price: <br>
                            min:<input type="number" step="0.01" placeholder="0.00" max="99999" name="min-price" id="desktop-price" class="form-control" value="0">
                            max:<input type="number" step="0.01" placeholder="0.00" max="99999" name="max-price" id="desktop-price" class="form-control" value="0">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm" name="client-search-desktop-form" id="client-search-desktop-form">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!--/.sidebar-offcanvas-->
</div>

    @endsection