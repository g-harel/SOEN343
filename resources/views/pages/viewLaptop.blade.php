@extends('layouts.app')
@section('content')


<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-12 col-sm-9">
        <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
        </p>
        @if(empty($laptopDetails))
        <div class="row">
            @foreach($laptops as $laptop)
            <div class="col-xs-6 col-lg-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{ $laptop['brand'] }}, {{ $laptop['hddSize'] }} GB {{ $laptop["displaySize"] }}"
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <i class="fa fa-laptop fa-5x"></i>
                            </div>
                            <div class="col-md-6">
                                <p>Price: ${{ $laptop['price'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="list-group">
                                <li>Processor Type: <b>{{ $laptop['processorType'] }}</b></li>
                                <li>Ram Size: <b>{{ $laptop['ramSize'] }}</b></li>
                                <li>Cpu cores: <b>{{ $laptop['cpuCores'] }}</b></li>
                                <li>Hard Disk Size: <b>{{ $laptop['hddSize'] }} GB</b></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span><a class="btn btn-default" href="/view/laptop/{{ $laptop['id'] }}" role="button">View details »</a></span>
                        <span><a class="btn btn-default" href="#" role="button">Add to Cart »</a></span>
                    </div>
                </div>
            </div>
            @endforeach
            @if(empty($laptops))
                <p>Laptop item catalog is currently empty.</p>
            @endif
        </div>
        @endif

        @if(!empty($laptopDetails))
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
                                <p>Quantity: <b>{{$laptopDetails['quantity']}}</b></p>
                                <p>Price: <b>${{$laptopDetails['price']}}</b></p>
                                <p>Brand: <b>{{$laptopDetails['brand']}}</b></p>
                                <p>Processor Type: <b>{{$laptopDetails['processorType']}}</b></p>
                                <p>OS: <b>{{$laptopDetails['os']}}</b></p>
                                <p>Hard Disk Size: <b>{{$laptopDetails['hddSize']}} GB</b></p>
                                <p>Ram Size: <b>{{$laptopDetails['ramSize']}} GB</b></p>
                                <p>Display Size: <b>{{$laptopDetails['displaySize']}} inches</b></p>
                                <p>Weight: <b>{{$laptopDetails['weight']}} kg</b></p>
                                <p>Battery: <b>{{$laptopDetails['battery']}}</b></p>
                                <p>Camera: <b>{{$laptopDetails['camera']}}</b></p>
                                @if($laptopDetails["isTouchscreen"] == 0)
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
            </div><!--/.col-xs-6.col-lg-4-->
        @endif
    </div><!--/.col-xs-12.col-sm-9-->

    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
        <div class="list-group">
            <a href="/view/monitor" class="list-group-item">Monitor</a>
            <a href="/view/desktop" class="list-group-item">Desktop</a>
            <a href="/view/laptop" class="list-group-item active">Laptop</a>
            <a href="/view/tablet" class="list-group-item">Tablet</a>
        </div>
        <!-- advanced search -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Advanced Search</h3>
            </div>
            <div class="panel-body">
                <form id="laptop-form" class="form-horizontal" action="" method="POST">
                    <div class="col-md-12">
                        <div class="form-group">
                            Brand:
                            <select required="" name="laptop-brand" id="laptop-brand" class="form-control">
                                <option title="Select brands" value="">Select brands</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Hard Drive Size (GB):
                            <select required="" name="laptop-storage-capacity" id="laptop-storage-capacity" class="form-control">
                                <option title="Select storage qty" value="">Select storage size</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Price: <br>
                            min:<input type="number" min="1" step="0.01" placeholder="0.00" max="99999" name="laptop-price" id="laptop-price" class="form-control">
                            max:<input type="number" min="1" step="0.01" placeholder="0.00" max="99999" name="laptop-price" id="laptop-price" class="form-control" >
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm" name="search-laptop-form" id="search-laptop-form">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!--/.sidebar-offcanvas-->
</div>

    @endsection