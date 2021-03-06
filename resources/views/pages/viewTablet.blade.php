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
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{$value['brand']}} Tablet</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <i class="fa fa-tablet fa-5x"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="col-md-8">
                                            <p>Price: <b>${{$value['price']}}</b></p>
                                            <p>Brand: <b>{{$value['brand']}}</b></p>
                                            <p>Processor Type: <b>{{$value['processorType']}}</b></p>
                                            <p>OS: <b>{{$value['os']}}</b></p>
                                            <p>Hard Disk Size: <b>{{$value['hddSize']}} GB</b></p>
                                            <p>Ram Size: <b>{{$value['ramSize']}} GB</b></p>
                                            <p>Display Size: <b>{{$value['displaySize']}} inches</b></p>
                                            <p>Width: <b>{{$value['width']}} cm</b></p>
                                            <p>Height: <b>{{$value['height']}} cm</b></p>
                                            <p>Weight: <b>{{$value['weight']}} kg</b></p>
                                            <p>Thickness: <b>{{$value['thickness']}} cm</b></p>
                                            <p>Battery: <b>{{$value['battery']}}</b></p>
                                            <p>Camera: <b>{{$value['camera']}}</b></p>
                                            @if($value["isTouchscreen"] == 0)
                                                <p>Touchscreen: <b>No</b></p>
                                            @else
                                                <p>Touchscreen: <b>Yes</b></p>
                                            @endif
                                            <p>Model #: <b>{{$value['model']}} </b> </p>
                                            <p>Serial #: <b>{{$value['serial']}} </b> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="panel-footer">
                                    <span><a class="btn btn-default" href="/view/tablet/{{$value['id']}}/{{$value['serial']}}" role="button">View details »</a></span>
                                </div>
                        </div>
                    </div><!--/.col-xs-6.col-lg-4-->
                </div>
            @endforeach
        @endif
        <!-- all tablets in the catalog -->
        @if(empty($details)  && empty($result))
        <div class="row">
        @foreach($tablets as $tablet)
            <div class="col-xs-6 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{ $tablet['brand'] }} {{ $tablet['hddSize'] }} GB {{ $tablet["displaySize"] }}"
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <i class="fa fa-tablet fa-5x"></i>
                            </div>
                            <div class="col-md-6">
                                <p >Price: ${{ $tablet['price'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="list-group">
                                <li>Processor Type: <b>{{ $tablet['processorType'] }}</b></li>
                                <li>Ram Size: <b>{{ $tablet['ramSize'] }} GB</b></li>
                                <li>Cpu cores: <b>{{ $tablet['cpuCores'] }}</b></li>
                                <li>Hard Disk Size: <b>{{ $tablet['hddSize'] }} GB</b></li>
                                <li>Model #: <b>{{ $tablet['model'] }}</b></li>
                                <li>Serial #: <b>{{$tablet['serial']}}</b></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-footer">
                    <form method="post" action="items/tablet/reserve">
                        <span><input class="btn btn-default" type="submit" role="submit" value="Add to Cart"></span>
                        <span><a class="btn btn-default" href="/view/tablet/{{$tablet['id']}}/{{$tablet['serial']}}" role="button">View details »</a></span>
                        <input type="hidden" name="serial" value="{{$tablet['serial']}}">
                    </form>
                    </div>
                </div>
            </div>
        @endforeach
        @if(empty($tablets))
            <p>Tablet item catalog is currently empty.</p>
        @endif
        </div>
        @endif
        @if(!empty($details))
        <!-- specific tablet  -->
        <div class="row">
            <div class="col-xs-12 col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{ $details['brand'] }}, {{ $details['hddSize'] }} GB {{ $details["displaySize"] }}"
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <i class="fa fa-tablet fa-5x"></i>
                            </div>
                            <div class="col-md-8">
                                <p>Price: <b>${{$details['price']}}</b></p>
                                <p>Brand: <b>{{$details['brand']}}</b></p>
                                <p>Processor Type: <b>{{$details['processorType']}}</b></p>
                                <p>OS: <b>{{$details['os']}}</b></p>
                                <p>Hard Disk Size: <b>{{$details['hddSize']}} GB</b></p>
                                <p>Ram Size: <b>{{$details['ramSize']}} GB</b></p>
                                <p>Display Size: <b>{{$details['displaySize']}} inches</b></p>
                                <p>Width: <b>{{$details['width']}} cm</b></p>
                                <p>Height: <b>{{$details['height']}} cm</b></p>
                                <p>Weight: <b>{{$details['weight']}} kg</b></p>
                                <p>Thickness: <b>{{$details['thickness']}} cm</b></p>
                                <p>Battery: <b>{{$details['battery']}}</b></p>
                                <p>Camera: <b>{{$details['camera']}}</b></p>
                                @if($details["isTouchscreen"] == 0)
                                    <p>Touchscreen: <b>No</b></p>
                                @else
                                    <p>Touchscreen: <b>Yes</b></p>
                                @endif
                                <p>Model #: <b>{{$details['model']}}</b></p>
                                <p>Serial #: <b>{{$details['serial']}}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- category filter -->
    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
        <div class="list-group">
            <a href="/view/monitor" class="list-group-item ">Monitor</a>
            <a href="/view/desktop" class="list-group-item">Desktop</a>
            <a href="/view/laptop" class="list-group-item">Laptop</a>
            <a href="/view/tablet" class="list-group-item active">Tablet</a>
        </div>
        <!-- advanced search -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Advanced Search</h3>
            </div>
            <div class="panel-body">
                <form id="tablet-form" class="form-horizontal" action="/view/computer/search" method="GET">
                    <div class="col-md-12">
                        <div class="form-group">
                            Brand:
                            <select  name="tablet-brand" id="tablet-brand" class="form-control">
                                <option title="Select brands" value="">Select brands</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Hard Drive Size (GB):
                            <select  name="tablet-storage-capacity" id="tablet-storage-capacity" class="form-control">
                                <option title="Select storage qty" value="">Select storage size</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Ram Size (GB):
                            <select  name="tablet-ram-size" id="tablet-ram-size" class="form-control">
                                <option title="Select tablet ram size" value="">Select ram size</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Price: <br>
                            min:<input type="number"  step="0.01" placeholder="0.00" max="99999" name="min-price" id="laptop-price" class="form-control" value="0">
                            max:<input type="number"  step="0.01" placeholder="0.00" max="99999" name="max-price" id="laptop-price" class="form-control" value="0">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm" name="client-search-tablet-form" id="client-search-tablet-form">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!--/.sidebar-offcanvas-->
</div>

    @endsection