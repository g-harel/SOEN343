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
    @if(Session::has('succeedModifyingItem'))
        <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>You have successfully modified this item.</p>
        </div>
    @endif
    @if(Session::has('deleteSuccess'))
        <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>You have successfully deleted this item.</p>
        </div>
    @endif
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
                        <a class="btn btn-danger btn-xs" data-id="{{ $desktop["id"] }}" data-toggle="modal"
                           data-target="#delDesktopLink">
                            <span class="fa fa-trash"></span>
                        </a>
                    </p>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

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
                                    <input type="hidden" name="desktop-id" id="desktop-id" class="form-control">
                                    <div class="form-group">
                                        Quantity:
                                        <input type="number" min="0" max="100" required name="desktop-qty" id="desktop-qty" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        Brand:
                                        <select required name="computer-brand" id="computer-brand" class="form-control">
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
                    <h4 class="modal-title">Removing desktop item(s)</h4>
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

@endsection