@extends('layouts.app')
@section('content')
<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-12 col-sm-9">
        <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
        </p>
        <!-- all tablets in the catalog -->
        @if(empty($tabletDetails))
        <div class="row">
        @foreach($tablets as $tablet)
            <div class="col-xs-6 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{ $tablet['brand'] }}, {{ $tablet['hddSize'] }} GB {{ $tablet["displaySize"] }}"
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
                                <li>Ram Size: <b>{{ $tablet['ramSize'] }}</b></li>
                                <li>Cpu cores: <b>{{ $tablet['cpuCores'] }}</b></li>
                                <li>Hard Disk Size: <b>{{ $tablet['hddSize'] }} GB</b></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span><a class="btn btn-default" href="/view/tablet/{{ $tablet['id'] }}" role="button">View details »</a></span>
                        <span><a class="btn btn-default" href="#" role="button">Add to Cart »</a></span>
                    </div>
                </div>
            </div>
        @endforeach
        @if(empty($tablets))
            <p>Tablet item catalog is currently empty.</p>
        @endif
        </div>
        @endif
        @if(!empty($tabletDetails))
        <!-- specific tablet  -->
        <div class="row">
            <div class="col-xs-12 col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{ $tabletDetails['brand'] }}, {{ $tabletDetails['hddSize'] }} GB {{ $tabletDetails["displaySize"] }}"
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <i class="fa fa-tablet fa-5x"></i>
                            </div>
                            <div class="col-md-8">
                                <p>Quantity: <b>{{$tabletDetails['quantity']}}</b></p>
                                <p>Price: <b>${{$tabletDetails['price']}}</b></p>
                                <p>Brand: <b>{{$tabletDetails['brand']}}</b></p>
                                <p>Processor Type: <b>{{$tabletDetails['processorType']}}</b></p>
                                <p>OS: <b>{{$tabletDetails['os']}}</b></p>
                                <p>Hard Disk Size: <b>{{$tabletDetails['hddSize']}} GB</b></p>
                                <p>Ram Size: <b>{{$tabletDetails['ramSize']}} GB</b></p>
                                <p>Display Size: <b>{{$tabletDetails['displaySize']}} inches</b></p>
                                <p>Width: <b>{{$tabletDetails['width']}} cm</b></p>
                                <p>Height: <b>{{$tabletDetails['height']}} cm</b></p>
                                <p>Weight: <b>{{$tabletDetails['weight']}} kg</b></p>
                                <p>Thickness: <b>{{$tabletDetails['thickness']}} cm</b></p>
                                <p>Battery: <b>{{$tabletDetails['battery']}}</b></p>
                                <p>Camera: <b>{{$tabletDetails['camera']}}</b></p>
                                @if($tabletDetails["isTouchscreen"] == 0)
                                    <p>Touchscreen: <b>No</b></p>
                                @else
                                    <p>Touchscreen: <b>Yes</b></p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span><a class="btn btn-default" href="#" role="button">Add to Cart »</a></span>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- category filter -->
    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
        <div class="list-group">
            <a href="/view/monitor" class="list-group-item">Monitor</a>
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
                <form id="tablet-form" class="form-horizontal" action="" method="POST">
                    <div class="col-md-12">
                        <div class="form-group">
                            Brand:
                            <select required="" name="tablet-brand" id="tablet-brand" class="form-control">
                                <option title="Select brands" value="">Select brands</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Hard Drive Size (GB):
                            <select required="" name="tablet-storage-capacity" id="tablet-storage-capacity" class="form-control">
                                <option title="Select storage qty" value="">Select storage size</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Price: <br>
                            min:<input type="number" min="1" step="0.01" placeholder="0.00" max="99999" name="tablet-price" id="laptop-price" class="form-control">
                            max:<input type="number" min="1" step="0.01" placeholder="0.00" max="99999" name="tablet-price" id="laptop-price" class="form-control" >
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm" name="search-tablet-form" id="search-tablet-form">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!--/.sidebar-offcanvas-->
</div>

    @endsection