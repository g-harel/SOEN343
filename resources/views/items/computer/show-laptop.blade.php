@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/items">Items</a></li>
        <li>Computer</li>
        <li class="active">Laptop</li>
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
        <tr>
            <td data-id="25">25</td>
            <td data-brand="IBM">IBM</td>
            <td data-price="1500">1500</td>
            <td data-qty="2">2</td>
            <td data-processor="Intel">Intel</td>
            <td data-ramSize="12">12</td>
            <td data-weight="5">5</td>
            <td data-cpuCores="4">4</td>
            <td data-hddSize="128GB">128GB</td>
            <td data-displaySize="14">14</td>
            <td data-battery="Li-ion">Li-Ion</td>
            <td data-os="Windows XP">Windows XP</td>
            <td data-camera="Yes">Yes</td>
            <td data-touchscreen="No">No</td>
            <td class="text-center">
                <p data-placement="top" data-toggle="tooltip" title="Edit">
                    <a class="btn btn-primary btn-xs edit-laptop-link" href="" data-toggle="modal" data-target=".bs-edit-laptop-modal-lg">
                        <span class="fa fa-scissors"></span>
                    </a>
                </p>
            </td>
            <td class="text-center">
                <p data-placement="top" data-toggle="tooltip" title="Delete">
                    <a class="btn btn-danger btn-xs" data-qty="2" data-id="25" data-toggle="modal" data-target="#delLaptopLink">
                        <span class="fa fa-trash"></span>
                    </a>
                </p>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="modal fade bs-edit-laptop-modal-lg" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editing Laptop</h4>
            </div>
            <div class="modal-body">
                <form id="laptop-form" class="form-horizontal">
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
                                    <option title="Select processor" selected disabled>Select processor type</option>
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
                                <select name="laptop-storage-capacity" id="laptop-storage-capacity" class="form-control">
                                    <option title="Select storage capacity" selected disabled>Select storage capacity</option>
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
                                <input type="radio" title="laptop touchscreen" name="laptop-touchscreen" value="Yes" id="laptop-camera">&nbsp;Yes
                                <input type="radio" title="laptop touchscreen" name="laptop-touchscreen" value="No" id="laptop-camera">&nbsp;No
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
                                <input type="text" name="laptop-price" id="laptop-price"  class="form-control">
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
                                <input type="radio" title="laptop camera" name="laptop-camera" value="Yes" id="laptop-camera">&nbsp;Yes
                                <input type="radio" title="laptop camera" name="laptop-camera" value="No" id="laptop-camera">&nbsp;No
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-lg" name="submit-laptop-form" id="submit-laptop-form">Submit</button>
                            </div>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Removing laptop item(s)</h4>
            </div>
            <div class="modal-body">
                <p>Please select the number of item to remove from the inventory.</p>
                <form >
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="item-id" id="item-id">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity to remove:</label>
                        <input type="number" max="" min="1" class="form-control" name="qty-to-remove" id="qty-to-remove">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-danger btn-sm" name="submit" value="Confirm">
                    </div>
                    <div class="form-group">
                        <input type="button" data-dismiss="modal" aria-label="Close" class="form-control" value="Cancel" name="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection