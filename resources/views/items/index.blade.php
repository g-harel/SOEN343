@extends('layouts.app')
@section('page-title')
    Dashboard
@endsection
@section('content')
    <div class="col-lg-3" style="float: left">
        @include('inc.category-sidebar')
    </div>
    <div class="col-lg-9" style="float: left">
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-desktop fa-5x"></i>
                        </div>
                    </div>
                </div>
                <a href="/items">
                    <div class="panel-footer">
                        <div class="col-sm-4">
                            <a href="/items/computer/showLaptop">
                                Laptop
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="/items/computer/showTablet">
                                Tablet
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="/items/computer/showDesktop">
                                Desktop
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tv fa-5x"></i>
                        </div>
                    </div>
                </div>
                <a href="/items/monitor/showMonitor">
                    <div class="panel-footer">
                        <a href="/items/monitor/showMonitor">
                            <span>Monitor</span>
                        </a>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection
