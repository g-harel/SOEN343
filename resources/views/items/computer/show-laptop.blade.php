@extends('layouts.app')
@section('page-title')
    Laptop Items
@endsection
@section('content')
    <ol class="breadcrumb">
        <li><a href="/items">Items</a></li>
        <li>Computer</li>
        <li class="active">Laptop</li>
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
                                <form id="laptop-form" class="form-horizontal" action="/items/computer/search" method="GET">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            Brand:
                                            <select name="laptop-brand" id="laptop-brand" class="form-control">
                                                <option title="Select brands" value="">Select brands</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            Hard Drive Size (GB):
                                            <select name="laptop-storage-capacity" id="laptop-storage-capacity" class="form-control">
                                                <option title="Select storage qty" value="">Select storage size</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            Ram Size (GB):
                                            <select name="laptop-ram-size" id="laptop-ram-size" class="form-control">
                                                <option title="Select laptop ram size" value="">Select ram size</option>
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
                                            <button type="submit" class="btn btn-success btn-sm" name="admin-search-laptop-form" id="admin-search-laptop-form">Search</button>
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
    <table class="table table-bordered table-responsive" id="laptopTable">
        <thead>
        <tr>
            <th class="hidden">#</th>
            <th>Model #</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Processor type</th>
            <th>Ram size</th>
            <th>Weight</th>
            <th>CPU cores</th>
            <th>HDD size</th>
            <th>Display Size (inches)</th>
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
                <td class="hidden" data-id="{{ $value["id"] }}">{{ $value["id"] }}</td>
                <td data-brand="{{ $value["model"] }}">{{ $value["model"] }}</td>
                <td data-brand="{{ $value["brand"] }}">{{ $value["brand"] }}</td>
                <td data-price="{{ $value["price"] }}">{{ $value["price"] }}</td>
                <td data-qty="{{ $value["quantity"] }}">{{ $value["quantity"] }}</td>
                <td data-processor="{{ $value["processorType"] }}">{{ $value["processorType"] }}</td>
                <td data-ramSize="{{ $value["ramSize"] }}">{{ $value["ramSize"] }}</td>
                <td data-weight="{{ $value["weight"] }}">{{ $value["weight"] }}</td>
                <td data-cpuCores="{{ $value["cpuCores"] }}">{{ $value["cpuCores"] }}</td>
                <td data-hddSize="{{ $value["hddSize"] }}">{{ $value["hddSize"] }}</td>
                <td data-displaySize="{{ $value["displaySize"] }}">{{ $value["displaySize"] }}</td>
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
                        <a class="btn btn-primary btn-xs edit-laptop-link" href="" data-toggle="modal"
                           data-target=".bs-edit-laptop-modal-lg">
                            <span class="fa fa-scissors"></span>
                        </a>
                    </p>
                </td>
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Delete">
                        <a class="btn btn-danger btn-xs" data-id="{{ $value["id"] }}" data-toggle="modal"
                           data-target="#delLaptopLink">
                            <span class="fa fa-trash"></span>
                        </a>
                    </p>
                </td>
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Add Units">
                        <a class="btn btn-success btn-xs" data-id="{{ $value["id"] }}" data-toggle="modal"
                           data-target="#addLaptopLink">
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
    <table class="table table-bordered table-responsive" id="laptopTable">
        <thead>
        <tr>
            <th class="hidden">#</th>
            <th>Model #</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Processor type</th>
            <th>Ram size</th>
            <th>Weight</th>
            <th>CPU cores</th>
            <th>HDD size</th>
            <th>Display Size (inches)</th>
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
        @foreach($laptops as $laptop)
            <tr>
                <td class="hidden" data-id="{{ $laptop["id"] }}">{{ $laptop["id"] }}</td>
                <td data-brand="{{ $laptop["model"] }}">{{ $laptop["model"] }}</td>
                <td data-brand="{{ $laptop["brand"] }}">{{ $laptop["brand"] }}</td>
                <td data-price="{{ $laptop["price"] }}">{{ $laptop["price"] }}</td>
                <td data-qty="{{ $laptop["quantity"] }}">{{ $laptop["quantity"] }}</td>
                <td data-processor="{{ $laptop["processorType"] }}">{{ $laptop["processorType"] }}</td>
                <td data-ramSize="{{ $laptop["ramSize"] }}">{{ $laptop["ramSize"] }}</td>
                <td data-weight="{{ $laptop["weight"] }}">{{ $laptop["weight"] }}</td>
                <td data-cpuCores="{{ $laptop["cpuCores"] }}">{{ $laptop["cpuCores"] }}</td>
                <td data-hddSize="{{ $laptop["hddSize"] }}">{{ $laptop["hddSize"] }}</td>
                <td data-displaySize="{{ $laptop["displaySize"] }}">{{ $laptop["displaySize"] }}</td>
                <td data-battery="{{ $laptop["battery"] }}">{{ $laptop["battery"] }}</td>
                <td data-os="{{ $laptop["os"] }}">{{ $laptop["os"] }}</td>
                <td data-camera="{{ $laptop["camera"] }}">{{ $laptop["camera"] }}</td>
                @if($laptop["isTouchscreen"] == 0)
                    <td data-touchscreen="{{ $laptop["isTouchscreen"] }}">No</td>
                @else
                    <td data-touchscreen="{{ $laptop["isTouchscreen"] }}">Yes</td>
                @endif
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                        <a class="btn btn-primary btn-xs edit-laptop-link" href="" data-toggle="modal"
                           data-target=".bs-edit-laptop-modal-lg">
                            <span class="fa fa-scissors"></span>
                        </a>
                    </p>
                </td>
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Delete">
                        <a class="btn btn-danger btn-xs" data-id="{{ $laptop["id"] }}" data-toggle="modal"
                           data-target="#delLaptopLink">
                            <span class="fa fa-trash"></span>
                        </a>
                    </p>
                </td>
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Add Units">
                        <a class="btn btn-success btn-xs" data-id="{{ $laptop["id"] }}" data-toggle="modal"
                           data-target="#addUnitsLaptopLink">
                            <span class="fa fa-plus"></span>
                        </a>
                    </p>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
    <div class="modal fade bs-edit-laptop-modal-lg" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editing Laptop</h4>
                </div>
                <div class="modal-body">
                    <form id="laptop-form" class="form-horizontal" action="/items/computer/laptop/modify" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-5">
                                    <input type="hidden" name="laptop-id" id="laptop-id" class="form-control">
                                    <div class="form-group">
                                        Brand:
                                        <select name="laptop-brand" id="laptop-brand" class="form-control">
                                            <option title="Select brands" selected disabled>Select brands</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Processor Type:
                                        <select name="laptop-processor" id="laptop-processor" class="form-control">
                                            <option title="Select processor" selected disabled>Select processor type
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        RAM Size:
                                        <select name="laptop-ram-size" id="laptop-ram-size" class="form-control">
                                            <option title="Select ram size" selected disabled>Select ram size</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Hard Drive Size:
                                        <select name="laptop-storage-capacity" id="laptop-storage-capacity"
                                                class="form-control">
                                            <option title="Select storage capacity" selected disabled>Select storage
                                                capacity
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Number of Cores:
                                        <select name="laptop-cpu-cores" id="laptop-cpu-cores" class="form-control">
                                            <option title="Select cpu cores" selected disabled>Select cpu cores</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Touchscreen:<br>
                                        <input type="radio" title="laptop touchscreen" name="laptop-touchscreen" value="1"
                                               id="laptop-camera">&nbsp;Yes
                                        <input type="radio" title="laptop touchscreen" name="laptop-touchscreen" value="0"
                                               id="laptop-camera">&nbsp;No
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        OS:
                                        <select name="laptop-os" id="laptop-os" class="form-control">
                                            <option title="Select os" selected disabled>Select OS</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Display size (inches):
                                        <select name="laptop-display-size" id="laptop-display-size" class="form-control">
                                            <option title="Select display size" selected disabled>Select display size</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Price:
                                        <input type="text" name="laptop-price" id="laptop-price" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        Weight (Kg):
                                        <input type="text" name="laptop-weight" id="laptop-weight" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        Battery:
                                        <input type="text" name="laptop-battery" id="laptop-battery" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        Camera:<br>
                                        <input type="radio" title="laptop camera" name="laptop-camera" value="Yes"
                                               id="laptop-camera">&nbsp;Yes
                                        <input type="radio" title="laptop camera" name="laptop-camera" value="No" id="laptop-camera">&nbsp;No
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit-laptop-form" id="submit-laptop-form">Save changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delLaptopLink" tabindex="-1" role="dialog" aria-labelledby="delLaptopLink">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Removing laptop specification</h4>
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
                    <form action="/items/computer/laptop/delete" method="post">
                        {{ csrf_field() }}
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

    <div class="modal fade addUnitsLaptopLink" id="addUnitsLaptopLink" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Adding Units</h4>
                </div>
                <div class="modal-body" id="edit-laptop-form-body">
                    <form id="laptop-form-units" class="form-horizontal unit-form" action="/items/computer/laptop/addLaptopUnits" method="POST">
                        <div class="col-md-12">
                            <input type="hidden" name="item-id" id="laptop-id" class="form-control">
                            <div class="form-group">
                                How many unit(s) with this specification would you like to add?
                                <input title="" name="num-of-units" id="num-of-units" type="number" min="1" max="10" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12" id="units-inputs-container"></div>
                        <div class="col-md-12" id="serial-next">
                            <div class="form-group">
                                <input type="button" class="btn btn-primary" name="laptop-serial" value="Next">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit-laptop-form"
                                        id="submit-laptop-form">Add Units
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection