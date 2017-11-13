@extends('layouts.app')
@section('content')


<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-12 col-sm-9">
        <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
        </p>
        @if(empty($details))
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
                                    <i class="fa fa-television fa-5x"></i>
                                </div>
                                <div class="col-md-6">
                                    <p>Price: ${{$desktop['price']}}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <ul class="list-group">
                                        <li>Processor Type: {{$desktop['processorType']}} </li>
                                        <li>Ram Size: {{$desktop['ramSize']}} </li>
                                        <li>CPU Cores: {{$desktop['cpuCores']}} </li>
                                        <li>Hard Disk Size: {{$desktop['hddSize']}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <span><a class="btn btn-default" href="/view/desktop/{{$desktop['id']}}" role="button">View details »</a></span>
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
                                    <p>Price: <strong>${{$details['price']}}</strong> </p>
                                    <p>Brand: <strong>{{$details['brand']}}</strong> </p>
                                    <p>Quantity: <strong>{{$details['quantity']}}</strong> </p>
                                    <p>Processor Type: <strong>{{$details['processorType']}} </strong> </p>
                                    <p>Ram Size: <strong>{{$details['ramSize']}} GB</strong> </p>
                                    <p>CPU Cores: <strong>{{$details['cpuCores']}} </strong> </p>
                                    <p>Hard Disk Size: <strong>{{$details['hddSize']}} GB</strong> </p>
                                    <p>Height: <strong>{{$details['height']}} cm</strong> </p>
                                    <p>Width: <strong>{{$details['width']}} cm</strong> </p>
                                    <p>Thickness: <strong>{{$details['thickness']}} cm</strong> </p>
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
                <form id="desktop-form" class="form-horizontal" action="/items/computer/search" method="GET">
                    <div class="col-md-12">
                        <div class="form-group">
                            Brand:
                            <select required="" name="desktop-brand" id="desktop-brand" class="form-control">
                                <option title="Select brands" value="">Select brands</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Hard Drive Size (GB):
                            <select required="" name="desktop-storage-capacity" id="desktop-storage-capacity" class="form-control">
                                <option title="Select storage qty" value="">Select storage size</option>
                            </select>
                        </div>

                        <div class="form-group">
                            Ram Size (GB):
                            <select required="" name="desktop-ram-size" id="desktop-ram-size" class="form-control">
                                <option title="Select desktop ram size" value="">Select ram size</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Price: <br>
                            min:<input type="number" min="1" step="0.01" placeholder="0.00" max="99999" name="desktop-price" id="desktop-price" class="form-control">
                            max:<input type="number" min="1" step="0.01" placeholder="0.00" max="99999" name="desktop-price" id="desktop-price" class="form-control" >
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm" name="search-desktop-form" id="search-desktop-form">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!--/.sidebar-offcanvas-->
</div>

    @endsection