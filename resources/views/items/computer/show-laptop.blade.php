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
    <p><a class="btn btn-success" href="/items/create">Add new</a></p>
    <table class="table table-bordered table-responsive">
        <thead>
        <tr>
            <th>#</th>
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
        </tr>
        </thead>
        <tbody>
        @foreach($laptops as $laptop)
            <tr>
                <td data-id="{{ $laptop["id"] }}">{{ $laptop["id"] }}</td>
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
                <td data-touchscreen="{{ $laptop["isTouchscreen"] }}">{{ $laptop["isTouchscreen"] }}</td>
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
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="modal fade bs-edit-laptop-modal-lg" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editing Laptop</h4>
                </div>
                <div class="modal-body">
                    <form id="laptop-form" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-5">
                                    <input type="hidden" name="laptop-id" id="laptop-id" class="form-control">
                                    <div class="form-group">
                                        Quantity:
                                        <input type="number" min="0" max="100" required name="laptop-qty" id="laptop-qty" class="form-control">
                                    </div>
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
                                        <input type="radio" title="laptop touchscreen" name="laptop-touchscreen" value="Yes"
                                               id="laptop-camera">&nbsp;Yes
                                        <input type="radio" title="laptop touchscreen" name="laptop-touchscreen" value="No"
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
                                            <option title="Select display size" selected disabled>Select display size
                                            </option>
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
                                        <input type="radio" title="laptop camera" name="laptop-camera" value="No"
                                               id="laptop-camera">&nbsp;No
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
                    <h4 class="modal-title">Removing laptop item(s)</h4>
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
                    <form>
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
@endsection