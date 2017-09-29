@extends('layouts.app')

@section('content')
    <div class="col-lg-2" style="float: left">
        @include('inc.category-sidebar')
    </div>
    <div class="row" style="float: left">
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tv fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">259</div>
                            <div>Televisions</div>
                        </div>
                    </div>
                </div>
                <a href="/items/tv/showTv">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-laptop fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">86</div>
                            <div>Computer Systems</div>
                        </div>
                    </div>
                </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-12">
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
                            </div>

                        </div>
                    </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-desktop fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">145</div>
                            <div>Monitors</div>
                        </div>
                    </div>
                </div>
                <a href="/items/monitor/showMonitor">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection
