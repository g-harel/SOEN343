@extends('layouts.app')
@section('page-title')
    Desktop Items
@endsection
@section('content')
    <ol class="breadcrumb">
        <li><a href="/items">Items</a></li>
        <li>Computer</li>
        <li class="active">Desktop</li>
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
    <!-- start filtering form -->
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
                                <form id="desktop-form" class="form-horizontal" action="/items/computer/search" method="GET">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            Brand:
                                            <select name="desktop-brand" id="desktop-brand" class="form-control">
                                                <option title="Select brands" value="">Select brands</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            Hard Drive Size (GB):
                                            <select name="desktop-storage-capacity" id="desktop-storage-capacity" class="form-control">
                                                <option title="Select storage qty" value="">Select storage size</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            Ram Size (GB):
                                            <select name="desktop-ram-size" id="desktop-ram-size" class="form-control">
                                                <option title="Select desktop ram size" value="">Select ram size</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            Min Price:
                                            <input type="number" step="0.01" placeholder="0.00" max="99999" name="min-price" id="desktop-price" class="form-control" value="0">
                                        </div>
                                        <div class="form-group">
                                            Max Price:
                                            <input type="number" step="0.01" placeholder="0.00" max="99999" name="max-price" id="desktop-price" class="form-control" value="0">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-sm" name="admin-search-desktop-form" id="admin-search-desktop-form">Search</button>
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
    </div><!-- end filtering form -->
    <!-- start filtering result -->
    @if(!empty($result))
        <table class="table table-bordered table-responsive" id="desktopTable" >
            <thead>
            <tr>
                <th class="hidden">#</th>
                <th>Model #</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Processor type</th>
                <th>Ram size (GB)</th>
                <th>CPU cores</th>
                <th>HDD size (GB)</th>
                <th>Weight</th>
                <th>Height (cm)</th>
                <th>Width (cm)</th>
                <th>Thickness (cm)</th>
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
                    <td data-cpuCores="{{ $value["cpuCores"] }}">{{ $value["cpuCores"] }}</td>
                    <td data-hddSize="{{ $value["hddSize"] }}">{{ $value["hddSize"] }}</td>
                    <td data-weight="{{ $value["weight"] }}">{{ $value["weight"] }}</td>
                    <td data-height="{{ $value["height"] }}">{{ $value["height"] }}</td>
                    <td data-width="{{ $value["width"] }}">{{ $value["width"] }}</td>
                    <td data-thickness="{{ $value["thickness"] }}">{{ $value["thickness"] }}</td>
                    <td class="text-center">
                        <p title="Edit">
                            <a class="btn btn-primary btn-xs edit-desktop-link" href="" data-toggle="modal"
                               data-target=".bs-del-desktop-modal">
                                <span class="fa fa-scissors"></span>
                            </a>
                        </p>
                    </td>
                    <td class="text-center">
                        <p title="Delete">
                            <a class="btn btn-danger btn-xs" data-id="{{ $value["id"] }}" data-toggle="modal"
                               data-target="#delDesktopLink">
                                <span class="fa fa-trash"></span>
                            </a>
                        </p>
                    </td>
                    <td class="text-center">
                        <p data-placement="top" data-toggle="tooltip" title="Add Units">
                            <a class="btn btn-success btn-xs" data-id="{{ $value["id"] }}" data-toggle="modal"
                               data-target="#addUnitsDesktopLink">
                                <span class="fa fa-plus"></span>
                            </a>
                        </p>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    <!-- end filtering result -->
    @if(empty($result))
    <table class="table table-bordered table-responsive" id="desktopTable">
        <thead>
        <tr>
            <th class="hidden">#</th>
            <th>Model #</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Processor type</th>
            <th>Ram size (GB)</th>
            <th>CPU cores</th>
            <th>HDD size (GB)</th>
            <th>Weight</th>
            <th>Height (cm)</th>
            <th>Width (cm)</th>
            <th>Thickness (cm)</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
            <th class="text-center">Add Units</th>
        </tr>
        </thead>
        <tbody>
        @foreach($desktops as $desktop)
            <tr>
                <td class="hidden" data-id="{{ $desktop["id"] }}">{{ $desktop["id"] }}</td>
                <td data-brand="{{ $value["model"] }}">{{ $value["model"] }}</td>
                <td data-brand="{{ $desktop["brand"] }}">{{ $desktop["brand"] }}</td>
                <td data-price="{{ $desktop["price"] }}">{{ $desktop["price"] }}</td>
                <td data-qty="{{ $desktop["quantity"] }}">{{ $desktop["quantity"] }}</td>
                <td data-processor="{{ $desktop["processorType"] }}">{{ $desktop["processorType"] }}</td>
                <td data-ramSize="{{ $desktop["ramSize"] }}">{{ $desktop["ramSize"] }}</td>
                <td data-cpuCores="{{ $desktop["cpuCores"] }}">{{ $desktop["cpuCores"] }}</td>
                <td data-hddSize="{{ $desktop["hddSize"] }}">{{ $desktop["hddSize"] }}</td>
                <td data-weight="{{ $desktop["weight"] }}">{{ $desktop["weight"] }}</td>
                <td data-height="{{ $desktop["height"] }}">{{ $desktop["height"] }}</td>
                <td data-width="{{ $desktop["width"] }}">{{ $desktop["width"] }}</td>
                <td data-thickness="{{ $desktop["thickness"] }}">{{ $desktop["thickness"] }}</td>
                <td class="text-center">
                    <p title="Edit">
                        <a class="btn btn-primary btn-xs edit-desktop-link" href="" data-toggle="modal"
                           data-target=".bs-del-desktop-modal">
                            <span class="fa fa-scissors"></span>
                        </a>
                    </p>
                </td>
                <td class="text-center">
                    <p title="Delete">
                        <a class="btn btn-danger btn-xs" data-id="{{ $desktop["id"] }}" data-toggle="modal"
                           data-target="#delDesktopLink">
                            <span class="fa fa-trash"></span>
                        </a>
                    </p>
                </td>
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Add Units">
                        <a class="btn btn-success btn-xs" data-id="{{ $desktop["id"] }}" data-toggle="modal"
                           data-target="#addUnitsDesktopLink">
                            <span class="fa fa-plus"></span>
                        </a>
                    </p>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
    <div class="modal fade bs-edit-desktop-modal-lg"  tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editing Desktop</h4>
                </div>
                <div class="modal-body" id="edit-desktop-form-body">
                    <form id="desktop-form" class="form-horizontal" action="/items/computer/desktop/modify" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-5">
                                    <input type="hidden" name="item-id" id="desktop-id" class="form-control">
                                    {{--<div class="form-group">--}}
                                        {{--Quantity:--}}
                                        {{--<input type="number" min="0" max="100" required name="desktop-qty" id="desktop-qty" class="form-control">--}}
                                    {{--</div>--}}
                                    <div class="form-group">
                                        Brand:
                                        <select required name="desktop-brand" id="desktop-brand" class="form-control">
                                            <option title="Select brands" value="">Select brands</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Processor Type:
                                        <select required name="desktop-processor" id="desktop-processor" class="form-control">
                                            <option title="Select processor" value="">Select processor</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        RAM Size:
                                        <select required name="desktop-ram-size" id="desktop-ram-size" class="form-control">
                                            <option title="Select ram size" value="">Select ram size</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Hard Drive Size (GB):
                                        <select required name="desktop-storage-capacity" id="desktop-storage-capacity" class="form-control">
                                            <option title="Select storage qty" value="">Select storage size</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Number of Cores:
                                        <select required name="desktop-cpu-cores" id="cpu-cores" class="form-control">
                                            <option title="Select cpu cores" value="">Select cpu cores</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        Price:
                                        <input required type="number" min="1" step="0.01" placeholder="0.00" max="99999" name="desktop-price" id="desktop-price" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        Weight (kg):
                                        <input required type="number" min="1" step="0.01" placeholder="0.00" name="desktop-weight" id="desktop-weight" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        Height (cm):
                                        <input required type="number" min="1" step="0.01" placeholder="0.00" name="desktop-height" id="desktop-height" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        Width (cm):
                                        <input required type="number" min="1" step="0.01" placeholder="0.00" name="desktop-width" id="desktop-width" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        Thickness (cm):
                                        <input required type="number" min="1" step="0.01" placeholder="0.00" name="desktop-thickness" id="desktop-thickness" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit-desktop-form" id="submit-desktop-form">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delDesktopLink" tabindex="-1" role="dialog" aria-labelledby="delDesktopLink">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Removing desktop specification</h4>
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
                    <form action="/items/computer/desktop/delete" method="post">
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

    <div class="modal fade addUnitsDesktopLink" id="addUnitsDesktopLink" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Adding Units</h4>
                </div>
                <div class="modal-body" id="edit-desktop-form-body">
                    <form id="desktop-form-units" class="form-horizontal unit-form" action="/items/computer/desktop/addDesktopUnits" method="POST">
                        <div class="col-md-12">
                            <input type="hidden" name="item-id" id="desktop-id" class="form-control">
                            <div class="form-group">
                                How many unit(s) with this specification would you like to add?
                                <input title="" name="num-of-units"id="num-of-units"  type="number" min="1" max="10" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12" id="units-inputs-container"></div>
                        <div class="col-md-12" id="serial-next">
                            <div class="form-group">
                                <input type="button" class="btn btn-primary" name="desktop-serial" value="Next">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit-desktop-form"
                                        id="submit-desktop-form">Add Units
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection