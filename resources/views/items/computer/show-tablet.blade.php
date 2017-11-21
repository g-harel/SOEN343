@extends('layouts.app')
@section('page-title')
    Tablet Items
@endsection
@section('content')
    <ol class="breadcrumb">
        <li><a href="/items">Items</a></li>
        <li>Computer</li>
        <li class="active">Tablet</li>
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
            <p>Units were not added.</p>
        </div>
    @endif
    @if(Session::has('itemSuccessfullyModified'))
        <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>You have successfully <b>modified</b> this item.</p>
        </div>
    @endif
    @if(Session::has('itemSuccessfullyDeleted'))
        <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>You have successfully <b>deleted</b> this item.</p>
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
            <label>{{$numResult}} result(s) found.</label>
        </div>
    @endif
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
                                <form id="tablet-form" class="form-horizontal" action="/items/computer/search" method="GET">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            Brand:
                                            <select name="tablet-brand" id="tablet-brand" class="form-control">
                                                <option title="Select brands" value="">Select brands</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            Hard Drive Size (GB):
                                            <select name="tablet-storage-capacity" id="tablet-storage-capacity" class="form-control">
                                                <option title="Select storage qty" value="">Select storage size</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            Ram Size (GB):
                                            <select name="tablet-ram-size" id="tablet-ram-size" class="form-control">
                                                <option title="Select tablet ram size" value="">Select ram size</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            Min Price:
                                            <input type="number"  step="0.01" placeholder="0.00" max="99999" name="min-price" id="laptop-price" class="form-control" value="0">
                                        </div>
                                        <div class="form-group">
                                            Max Price:
                                            <input type="number"  step="0.01" placeholder="0.00" max="99999" name="max-price" id="laptop-price" class="form-control" value="0">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-sm" name="admin-search-tablet-form" id="admin-search-tablet-form">Search</button>
                                        </div>
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
    @if(!empty($result))
    <table class="table table-bordered table-responsive" id="tabletTable" style="width:700px;">
        <thead>
        <tr>
            <th>#</th>
            <th>Qty</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Processor</th>
            <th>Ram size</th>
            <th>Weight</th>
            <th>CPU cores</th>
            <th>HDD size</th>
            <th>Display Size (inch.)</th>
            <th>Height (cm)</th>
            <th>Width (cm)</th>
            <th>Thickness (cm)</th>
            <th>Battery</th>
            <th>OS</th>
            <th>Camera</th>
            <th>Touchscreen</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
            <th class="text-center">Add Units</th>
        </tr>
        </thead>
        <tbody>
        @foreach($result as $value)
            <tr>
                <td data-id="{{ $value["id"] }}">{{ $value["id"] }}</td>
                <td data-qty="{{ $value["quantity"] }}">{{ $value["quantity"] }}</td>
                <td data-brand="{{ $value["brand"] }}">{{ $value["brand"] }}</td>
                <td data-price="{{ $value["price"] }}">{{ $value["price"] }}</td>
                <td data-processor="{{ $value["processorType"] }}">{{ $value["processorType"] }}</td>
                <td data-ramSize="{{ $value["ramSize"] }}">{{ $value["ramSize"] }}</td>
                <td data-weight="{{ $value["weight"] }}">{{ $value["weight"] }}</td>
                <td data-cpuCores="{{ $value["cpuCores"] }}">{{ $value["cpuCores"] }}</td>
                <td data-hddSize="{{ $value["hddSize"] }}">{{ $value["hddSize"] }}</td>
                <td data-displaySize="{{ $value["displaySize"] }}">{{ $value["displaySize"] }}</td>
                <td data-height="{{ $value["height"] }}">{{ $value["height"] }}</td>
                <td data-width="{{ $value["width"] }}">{{ $value["width"] }}</td>
                <td data-thickness="{{ $value["thickness"] }}">{{ $value["thickness"] }}</td>
                <td data-battery="{{ $value["battery"] }}">{{ $value["battery"] }}</td>
                <td data-os="{{ $value["os"] }}">{{ $value["os"] }}</td>
                <td data-camera="{{ $value["camera"] }}">{{ $value["camera"] }}</td>
                @if($value["isTouchscreen"] == 0)
                    <td data-touchscreen="{{ $value["isTouchscreen"] }}">No</td>
                @else
                    <td data-touchscreen="{{ $value["isTouchscreen"] }}">Yes</td>
                @endif
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                        <a class="btn btn-primary btn-xs edit-tablet-link" href="" data-toggle="modal"
                           data-target=".bs-edit-tablet-modal-lg">
                            <span class="fa fa-scissors"></span>
                        </a>
                    </p>
                </td>
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Delete">
                        <a class="btn btn-danger btn-xs" data-id="{{ $value["id"] }}" data-toggle="modal"
                           data-target="#delTabletLink">
                            <span class="fa fa-trash"></span>
                        </a>
                    </p>
                </td>
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Add Units">
                        <a class="btn btn-success btn-xs" data-id="{{ $value["id"] }}" data-toggle="modal"
                           data-target="#tablet-form-units">
                            <span class="fa fa-plus"></span>
                        </a>
                    </p>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
    @if(empty($result))
    <table class="table table-bordered table-responsive" id="tabletTable" style="width:700px;">
        <thead>
        <tr>
            <th>#</th>
            <th>Qty</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Processor</th>
            <th>Ram size</th>
            <th>Weight</th>
            <th>CPU cores</th>
            <th>HDD size</th>
            <th>Display Size (inch.)</th>
            <th>Height (cm)</th>
            <th>Width (cm)</th>
            <th>Thickness (cm)</th>
            <th>Battery</th>
            <th>OS</th>
            <th>Camera</th>
            <th>Touchscreen</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
            <th class="text-center">Add Units</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tablets as $tablet)
            <tr>
                <td data-id="{{ $tablet["id"] }}">{{ $tablet["id"] }}</td>
                <td data-qty="{{ $tablet["quantity"] }}">{{ $tablet["quantity"] }}</td>
                <td data-brand="{{ $tablet["brand"] }}">{{ $tablet["brand"] }}</td>
                <td data-price="{{ $tablet["price"] }}">{{ $tablet["price"] }}</td>
                <td data-processor="{{ $tablet["processorType"] }}">{{ $tablet["processorType"] }}</td>
                <td data-ramSize="{{ $tablet["ramSize"] }}">{{ $tablet["ramSize"] }}</td>
                <td data-weight="{{ $tablet["weight"] }}">{{ $tablet["weight"] }}</td>
                <td data-cpuCores="{{ $tablet["cpuCores"] }}">{{ $tablet["cpuCores"] }}</td>
                <td data-hddSize="{{ $tablet["hddSize"] }}">{{ $tablet["hddSize"] }}</td>
                <td data-displaySize="{{ $tablet["displaySize"] }}">{{ $tablet["displaySize"] }}</td>
                <td data-height="{{ $tablet["height"] }}">{{ $tablet["height"] }}</td>
                <td data-width="{{ $tablet["width"] }}">{{ $tablet["width"] }}</td>
                <td data-thickness="{{ $tablet["thickness"] }}">{{ $tablet["thickness"] }}</td>
                <td data-battery="{{ $tablet["battery"] }}">{{ $tablet["battery"] }}</td>
                <td data-os="{{ $tablet["os"] }}">{{ $tablet["os"] }}</td>
                <td data-camera="{{ $tablet["camera"] }}">{{ $tablet["camera"] }}</td>
                @if($tablet["isTouchscreen"] == 0)
                    <td data-touchscreen="{{ $tablet["isTouchscreen"] }}">No</td>
                @else
                    <td data-touchscreen="{{ $tablet["isTouchscreen"] }}">Yes</td>
                @endif
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                        <a class="btn btn-primary btn-xs edit-tablet-link" href="" data-toggle="modal"
                           data-target=".bs-edit-tablet-modal-lg">
                            <span class="fa fa-scissors"></span>
                        </a>
                    </p>
                </td>
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Delete">
                        <a class="btn btn-danger btn-xs" data-id="{{ $tablet["id"] }}" data-toggle="modal"
                           data-target="#delTabletLink">
                            <span class="fa fa-trash"></span>
                        </a>
                    </p>
                </td>
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Add Units">
                        <a class="btn btn-success btn-xs" data-id="{{ $tablet["id"] }}" data-toggle="modal"
                           data-target="#addUnitsTabletLink">
                            <span class="fa fa-plus"></span>
                        </a>
                    </p>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
    <div class="modal fade bs-edit-tablet-modal-lg" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editing Tablet</h4>
                </div>
                <div class="modal-body">
                    <form id="tablet-form" class="form-horizontal" action="/items/computer/tablet/modify" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-5">
                                    <input type="hidden" name="item-id" id="tablet-id" class="form-control">
                                    <div class="form-group">
                                        Brand:
                                        <select name="tablet-brand" id="tablet-brand" class="form-control">
                                            <option title="Select brands" selected disabled>Select brands</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Processor Type:
                                        <select name="tablet-processor" id="tablet-processor" class="form-control">
                                            <option title="Select processor" selected disabled>Select processor</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        RAM Size:
                                        <select name="tablet-ram-size" id="tablet-ram-size" class="form-control">
                                            <option title="Select ram size" selected disabled>Select ram size</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Hard Drive Size:
                                        <select name="tablet-storage-capacity" id="tablet-storage-capacity"
                                                class="form-control">
                                            <option title="Select storage capacity" selected disabled>Select storage
                                                capacity
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Number of Cores:
                                        <select name="tablet-cpu-cores" id="tablet-cpu-cores" class="form-control">
                                            <option title="Select cpu cores" selected disabled>Select cpu cores</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        OS:
                                        <select name="tablet-os" id="tablet-os" class="form-control">
                                            <option title="Select OS" selected disabled>Select OS</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Display size (inches):
                                        <select name="tablet-display-size" id="tablet-display-size" class="form-control">
                                            <option title="Select display size" selected disabled>Select display size
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        Price:
                                        <input type="text" name="tablet-price" id="tablet-price" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        Thickness (cm):
                                        <input type="text" name="tablet-thickness" id="tablet-thickness"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        Weight (Kg):
                                        <input type="text" name="tablet-weight" id="tablet-weight" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        Height (cm):
                                        <input type="text" name="tablet-height" id="tablet-height" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        Width:
                                        <input type="text" name="tablet-width" id="tablet-width" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        Battery:
                                        <input type="text" name="tablet-battery" id="tablet-battery" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        Camera:<br>
                                        <input type="radio" title="tablet camera" name="tablet-camera" value="Yes">&nbsp;Yes
                                        <input type="radio" title="tablet camera" name="tablet-camera" value="No">&nbsp;No
                                    </div>
                                    <div class="form-group">
                                        Touchscreen:<br>
                                        <input type="radio" title="tablet touchscreen" name="tablet-touchscreen" value="1">&nbsp;Yes
                                        <input type="radio" title="tablet touchscreen" name="tablet-touchscreen" value="0">&nbsp;No
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit-tablet-form" id="submit-tablet-form">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delTabletLink" tabindex="-1" role="dialog" aria-labelledby="delTabletLink">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Removing tablet item(s)</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2">
                            <p><i class="fa fa-exclamation-triangle fa-5x" aria-hidden="true"></i></p>
                        </div>
                        <div class="col-md-10">
                            <h4>Are you sure that you want to permanently delete the selected items(s)?</h4>
                        </div>
                    </div>
                    <form action="/items/computer/tablet/delete" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="item-id" id="item-id" value="">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-danger btn-sm" name="submit" value="Confirm">
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

    <div class="modal fade addUnitsTabletLink" id="addUnitsTabletLink" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Adding Units</h4>
                </div>
                <div class="modal-body" id="edit-tablet-form-body">
                    <form id="tablet-form-units" class="form-horizontal unit-form" action="/items/computer/tablet/addTabletUnits" method="POST">
                        <div class="col-md-12">
                            <input type="hidden" name="tablet-id" id="tablet-id" class="form-control">
                            <div class="form-group">
                                How many unit(s) with this specification would you like to add?
                                <input title="" name="num-of-units" id="num-of-units"  type="number" min="1" max="10" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12" id="units-inputs-container"></div>
                        <div class="col-md-12" id="serial-next">
                            <div class="form-group">
                                <input type="button" class="btn btn-primary" name="tablet-serial" value="Next">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit-tablet-form"
                                        id="submit-tablet-form">Add Units
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection