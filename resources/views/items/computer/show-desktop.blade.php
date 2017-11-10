@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/items">Items</a></li>
        <li>Computer</li>
        <li class="active">Desktop</li>
    </ol>
    <div class="col-lg-9">
        <p><a class="btn btn-success" href="/items/create">Add new</a></p>
        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th>#</th>
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
            </tr>
            </thead>
            <tbody>
            @foreach($desktops as $desktop)
                <tr>
                    <td data-id="{{ $desktop["id"] }}">{{ $desktop["id"] }}</td>
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
                            <a class="btn btn-danger btn-xs" href="" data-qty="20" data-id="8" data-toggle="modal"
                               data-target="#delDesktopLink">
                                <span class="fa fa-trash"></span>
                            </a>
                        </p>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade bs-edit-desktop-modal-lg" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editing Desktop</h4>
                </div>
                <div class="modal-body" id="edit-desktop-form-body">
                    <form id="desktop-form" class="form-horizontal">
                        <div class="col-md-12">
                            <div class="col-md-5">
                                <input type="hidden" name="desktop-id" id="desktop-id" class="form-control">
                                <div class="form-group">
                                    Brand:
                                    <select name="computer-brand" id="computer-brand" class="form-control">
                                        <option value="Select brands" title="Select brands" selected disabled>Select
                                            brands
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    Processor Type:
                                    <select name="desktop-processor" id="desktop-processor" class="form-control">
                                        <option value="Select processor" title="Select processor" selected disabled>
                                            Select processor
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    RAM Size:
                                    <select name="desktop-ram-size" id="desktop-ram-size" class="form-control">
                                        <option value="Select ram size" title="Select ram size" selected disabled>Select
                                            ram size
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    Hard Drive Size:
                                    <select name="storage-capacity" id="storage-capacity" class="form-control">
                                        <option value="Select hdd size" title="Select hdd size" selected disabled>Select
                                            HDD size
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    Number of Cores:
                                    <select name="desktop-cpu-cores" id="cpu-cores" class="form-control">
                                        <option value="Select number of cores" title="Select number of cores" selected
                                                disabled>Select cpu cores
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    Price:
                                    <input type="text" name="desktop-price" id="desktop-price" class="form-control">
                                </div>
                                <div class="form-group">
                                    Weight (Kg):
                                    <input type="text" name="desktop-weight" id="desktop-weight" class="form-control">
                                </div>
                                <div class="form-group">
                                    Height (cm):
                                    <input type="text" name="desktop-height" id="desktop-height" class="form-control">
                                </div>
                                <div class="form-group">
                                    Width (cm):
                                    <input type="text" name="desktop-width" id="desktop-width" class="form-control">
                                </div>
                                <div class="form-group">
                                    Thickness (cm):
                                    <input type="text" name="desktop-thickness" id="desktop-thickness"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-lg" name="submit-desktop-form"
                                            id="submit-desktop-form">Submit
                                    </button>
                                </div>
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
                    <h4 class="modal-title">Removing desktop item(s)</h4>
                </div>
                <div class="modal-body">
                    <p>Please select the number of item to remove from the inventory.</p>
                    <form>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="item-id" id="item-id">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity to remove:</label>
                            <input type="number" max="" min="1" class="form-control" name="qty-to-remove"
                                   id="qty-to-remove">
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