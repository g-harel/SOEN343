@extends('layouts.app')
@section('page-title')
    Monitor Items
@endsection
@section('content')
    <ol class="breadcrumb">
        <li><a href="/items">Items</a></li>
        <li class="active">Monitors</li>
    </ol>
    @if(Session::has('unitsAdded'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>Units were successfully added.</p>
        </div>
    @endif
    @if(Session::has('unitsNotAdded'))
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>Units were not added</p>
        </div>
    @endif
    @if(Session::has('itemSuccessfullyDeleted'))
        <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>You have successfully <b>deleted</b> this item.</p>
        </div>
    @endif
    @if(Session::has('itemSuccessfullyModified'))
        <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>You have successfully <b>modified</b> this item.</p>
        </div>
    @endif
    @if(Session::has('inputErrors'))
        @foreach(Session::get('inputErrors') as $value)
            <div class='alert alert-warning'>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>Invalid {{str_replace('-', ' ', $value)}}. Please try again.</p>
            </div>
        @endforeach
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
            <label>{{$numResult}} result(s) found. Go <a href="/items/monitor/showMonitor">back</a>.</label>
        </div>
    @endif
    <!-- filtering form -->
    <div class="row">
        <div class="col-md-1">
            <p><a href="/items/create" class="btn btn-success">Add new</a></p>
        </div>
        <div class="col-md-11">
            <div class="input-group" id="adv-search">
                <input type="text" readonly="" class="form-control search-by" placeholder="Search by" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <div class="dropdown dropdown-lg">
                            <button type="button" class="btn btn-default dropdown-toggle btn-lg" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <form id="monitor-form" class="form-horizontal" action="/items/monitor/search" method="get">
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
                                        Min Price:
                                        <input type="number" step="0.01" placeholder="min" max="99999" name="min-price" id="monitor-price" class="form-control" value="0">
                                    </div>
                                    <div class="form-group">
                                        Max Price:
                                        <input type="number" step="0.01" placeholder="max" max="99999" name="max-price" id="monitor-price" class="form-control" value="0">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm" name="admin-search-monitor-form" id="admin-search-monitor-form">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary search-by"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end filtering monitor form -->
    <!-- filtering result -->
    @if(!empty($searchResult))
        <table class="table table-bordered bg-color-white" id="monitorTable">
            <thead>
            <tr>
                <th class="hidden">#</th>
                <th>Model</th>
                <th>Qty</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Display Size (inches)</th>
                <th>Weight (kg)</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
                <th class="text-center">Add Units</th>
            </tr>
            </thead>
            <tbody>
            @foreach($searchResult as $value)
                <tr>
                    <td class= "hidden" data-id="{{ $value["id"] }}">{{ $value["id"] }}</td>
                    <td data-model="{{ $value["model"] }}">{{ $value["model"] }}</td>
                    <td data-qty="{{ $value["quantity"] }}">{{ $value["quantity"] }}</td>
                    <td data-brand="{{ $value["brand"] }}">{{ $value["brand"] }}</td>
                    <td data-price="{{ $value["price"] }}">{{ $value["price"] }}</td>
                    <td data-displaySize="{{ $value["displaySize"] }}">{{ $value["displaySize"] }}</td>
                    <td data-weight="{{ $value["weight"] }}">{{ $value["weight"] }}</td>
                    <td class="text-center">
                        <p data-placement="top" data-toggle="tooltip" title="Edit">
                            <a class="btn btn-primary btn-xs edit-monitor-link" href="" data-toggle="modal"
                               data-target=".bs-edit-monitor-modal-lg">
                                <span class="fa fa-scissors"></span>
                            </a>
                        </p>
                    </td>
                    <td class="text-center">
                        <p data-placement="top" data-toggle="tooltip" title="Delete">
                            <a class="btn btn-danger btn-xs" data-id="{{ $value["id"] }}" data-toggle="modal"
                               data-target="#delMonitorLink">
                                <span class="fa fa-trash"></span>
                            </a>
                        </p>
                    </td>
                    <td class="text-center">
                        <p data-placement="top" data-toggle="tooltip" title="Add Units">
                            <a class="btn btn-success btn-xs" data-id="{{ $value["id"] }}" data-toggle="modal"
                               data-target="#addMonitorLink">
                                <span class="fa fa-plus"></span>
                            </a>
                        </p>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    <!-- end filtering -->
    @if(empty($searchResult))
    <table class="table table-bordered bg-color-white" id="monitorTable">
        <thead>
        <tr>
            <th class="hidden">#</th>
            <th>Model</th>
            <th>Qty</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Display Size (inches)</th>
            <th>Weight (kg)</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
            <th class="text-center">Add Units</th>
        </tr>
        </thead>
        <tbody>
        @foreach($monitors as $monitor)
            <tr>
                <td class="hidden" data-id="{{ $monitor["id"] }}">{{ $monitor["id"] }}</td>
                <td data-model="{{ $monitor["model"] }}">{{ $monitor["model"] }}</td>
                <td data-qty="{{ $monitor["quantity"] }}">{{ $monitor["quantity"] }}</td>
                <td data-brand="{{ $monitor["brand"] }}">{{ $monitor["brand"] }}</td>
                <td data-price="{{ $monitor["price"] }}">{{ $monitor["price"] }}</td>
                <td data-displaySize="{{ $monitor["displaySize"] }}">{{ $monitor["displaySize"] }}</td>
                <td data-weight="{{ $monitor["weight"] }}">{{ $monitor["weight"] }}</td>
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                        <a class="btn btn-primary btn-xs edit-monitor-link" href="" data-toggle="modal"
                           data-target=".bs-edit-monitor-modal-lg">
                            <span class="fa fa-scissors"></span>
                        </a>
                    </p>
                </td>
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Delete">
                        <a class="btn btn-danger btn-xs" data-id="{{ $monitor["id"] }}" data-toggle="modal"
                           data-target="#delMonitorLink">
                            <span class="fa fa-trash"></span>
                        </a>
                    </p>
                </td>
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Add Units">
                        <a class="btn btn-success btn-xs" data-id="{{ $monitor["id"] }}" data-toggle="modal"
                           data-target="#addUnitsMonitorLink">
                            <span class="fa fa-plus"></span>
                        </a>
                    </p>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
    <div class="modal fade bs-edit-monitor-modal-lg" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editing Monitor</h4>
                </div>
                <div class="modal-body" id="edit-monitor-form-body">
                    <form id="monitor-form" class="form-horizontal" action="/items/monitor/modify" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="2"></div>
                                <div class="col-md-7">
                                    <input type="hidden" name="monitor-id" id="monitor-id" class="form-control">
                                    <div class="form-group">
                                        Model #:
                                        <div class="input-group">
                                            <span class="input-group-addon">MON-</span>
                                            <input readonly required type="text" maxlength="9" pattern="\d*" placeholder="Enter a Model Number no greater than 9" name="monitor-model" id="monitor-model" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        Brand Name:
                                        <select name="monitor-brand" id="monitor-brand" class="form-control">
                                            <option title="Select brands" selected disabled>Select brands</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Price:
                                        <input type="number" min="1" step="0.01" placeholder="0.00" max="99999" name="monitor-price" id="monitor-price" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        Display size (inches):
                                        <select name="monitor-display-size" id="monitor-display-size" class="form-control" required>
                                            <option title="Select display size" selected disabled>Select display size</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Weight (kg):
                                        <input type="number" min="1" step="0.01" placeholder="0.00" name="monitor-weight" id="monitor-weight" class="form-control" required>
                                    </div>
                                </div>
                                <div class="2"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit-monitor-form" id="submit-monitor-form">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delMonitorLink" tabindex="-1" role="dialog" aria-labelledby="delMonitorLink">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Removing monitor specification</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2">
                            <p><i class="fa fa-exclamation-triangle fa-5x" aria-hidden="true"></i></p>
                        </div>
                        <div class="col-md-10">
                            <h4>You are about to remove this specification from the inventory.</h4>
                        </div>
                    </div>
                    <form action="/items/monitor/delete" method="post">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="item-id" id="item-id">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-danger btn-sm" name="submit"
                                   value="Confirm">
                        </div>
                        <div class="form-group">
                            <input type="button" data-dismiss="modal" aria-label="Close" class="form-control"
                                   value="Cancel" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade addUnitsMonitorLink" id="addUnitsMonitorLink" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Adding Units</h4>
                </div>
                <div class="modal-body" id="edit-monitor-form-body">
                    <form id="monitor-form-units" class="form-horizontal unit-form" action="/items/monitor/AddUnits" method="POST">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <input type="hidden" name="item-id" id="monitor-id" class="form-control" value="">
                            <div class="form-group">
                                How many unit(s) with this specification would you like to add? (max: 10 per attempt)
                                <input title="" name="num-of-units" id="num-of-units" type="number" min="1" max="10" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12" id="units-inputs-container"></div>
                        <div class="col-md-12" id="serial-next">
                            <div class="form-group">
                                <input type="button" class="btn btn-primary generate-serial-form" name="monitor-serial" value="Next">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input disabled type="submit" class="btn btn-primary" name="submit-add-units"
                                        id="submit-monitor-form" value="Add Units">
                                </input>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection