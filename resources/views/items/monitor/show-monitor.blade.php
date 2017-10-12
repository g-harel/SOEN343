@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/items">Items</a></li>
        <li class="active">Monitors</li>
    </ol>
    <div class="col-lg-9">
        <p><a href="../create" class="btn btn-success">Add new</a></p>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Display Size (inches)</th>
                <th>Weight (kg)</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row" id="1">1</th>
                <td>Dell</td>
                <td>1000</td>
                <td>43</td>
                <td>34</td>
                <td>5</td>
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                        <a class="btn btn-primary btn-xs" href="items/monitor/edit/2" data-toggle="modal" data-target=".bs-edit-monitor-modal-lg">
                            <span class="fa fa-scissors"></span>
                        </a>
                    </p>
                </td>
                <td class="text-center"><p data-placement="top" data-toggle="tooltip" title="Delete"><a class="btn btn-danger btn-xs" ><span class="fa fa-trash"></span></a></p></td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Large modal -->
    {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>--}}

    <div class="modal fade bs-edit-monitor-modal-lg" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editing Monitor with id#1</h4>
                </div>
                <div class="modal-body">
                    {{-- template for editing / use the same as create --}}
                    <form id="monitor-form" class="form-horizontal">
                        <div class="col-md-12">
                            <div class="2"></div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    Brand Name:
                                    <select name="monitor-brand" id="monitor-brand" class="form-control">
                                        <option value="Select brands" title="Select brands" selected="" disabled="">Select brands</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    Price:
                                    <input type="text" name="monitor-price" id="monitor-price" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    Display size (inches):
                                    <select name="monitor-display-size" id="monitor-display-size" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group">
                                    Weight (Kg):
                                    <input type="text" name="monitor-weight" id="monitor-weight" class="form-control">
                                </div>
                            </div>
                            <div class="2"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-primary btn-lg" name="submit-monitor-form" id="submit-monitor-form">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection