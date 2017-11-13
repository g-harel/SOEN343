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
    @if(Session::has('deleteSuccess'))
        <div class="row">
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>You have successfully deleted this item.</p>
            </div>
        </div>
    @endif
    <p><a class="btn btn-success" href="/items/create">Add new</a></p>
    <table class="table table-bordered table-responsive" id="tabletTable" style="width:700px;">
        <thead>
        <tr>
            <th>#</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Qty</th>
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
        </tr>
        </thead>
        <tbody>
        @foreach($tablets as $tablet)
            <tr>
                <td data-id="{{ $tablet["id"] }}">{{ $tablet["id"] }}</td>
                <td data-brand="{{ $tablet["brand"] }}">{{ $tablet["brand"] }}</td>
                <td data-price="{{ $tablet["price"] }}">{{ $tablet["price"] }}</td>
                <td data-qty="{{ $tablet["quantity"] }}">{{ $tablet["quantity"] }}</td>
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
                <td data-touchscreen="{{ $tablet["isTouchscreen"] }}">{{ $tablet["isTouchscreen"] }}</td>
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
            </tr>
    @endforeach
        </tbody>
    </table>

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
                                    <input type="hidden" name="tablet-id" id="tablet-id" class="form-control">
                                    <div class="form-group">
                                        Quantity:
                                        <input type="number" min="0" max="100" required name="tablet-qty" id="tablet-qty" class="form-control">
                                    </div>
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
                                        <input type="radio" title="tablet touchscreen" name="tablet-touchscreen"
                                               value="Yes">&nbsp;Yes
                                        <input type="radio" title="tablet touchscreen" name="tablet-touchscreen" value="No">&nbsp;No
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
@endsection