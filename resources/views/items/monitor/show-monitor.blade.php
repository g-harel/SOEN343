@extends('layouts.app')
@section('page-title')
    Monitor Items
@endsection
@section('content')
    <ol class="breadcrumb">
        <li><a href="/items">Items</a></li>
        <li class="active">Monitors</li>
    </ol>
    <p><a href="../create" class="btn btn-success">Add new</a></p>
    <table class="table table-bordered bg-color-white">
        <thead>
        <tr>
            <th>#</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Display Size (inches)</th>
            <th>Weight (kg)</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($monitors as $monitor)
            <tr>
                <td data-id="{{ $monitor["id"] }}">{{ $monitor["id"] }}</td>
                <td data-brand="{{ $monitor["brand"] }}">{{ $monitor["brand"] }}</td>
                <td data-price="{{ $monitor["price"] }}">{{ $monitor["price"] }}</td>
                <td data-qty="{{ $monitor["quantity"] }}">{{ $monitor["quantity"] }}</td>
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
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="modal fade bs-edit-monitor-modal-lg" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editing Monitor</h4>
                </div>
                <div class="modal-body" id="edit-monitor-form-body">
                    <form id="monitor-form" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="2"></div>
                                <div class="col-md-7">
                                    <input type="hidden" name="monitor-id" id="monitor-id" class="form-control">
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
                    <h4 class="modal-title">Removing monitor item(s)</h4>
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

@endsection