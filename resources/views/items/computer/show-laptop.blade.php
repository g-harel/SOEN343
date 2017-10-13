@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/items">Items</a></li>
        <li>Computer</li>
        <li class="active">Laptop</li>
    </ol>
<div class="col-lg-9">
    <p><button class="btn btn-success create-new-items">Add new</button></p>
    <table class="table table-bordered table-responsive bg-color-white">
        <thead>
        <tr>
            <th>#</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Quantity</th>
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
            <td scope="row">1</td>
            <td>text here</td>
            <td>text here</td>
            <td>text here</td>
            <td>text here</td>
            <td>text here</td>
            <td>text here</td>
            <td>text here</td>
            <td>text here</td>
            <td>15'</td>
            <td>Mac</td>
            <td>--</td>
            <td>Yes</td>
            <td>No</td>
            <td class="text-center"><p data-placement="top" data-toggle="tooltip" title="Edit"> <a class="btn btn-primary btn-xs edit-laptop-link" href="" data-toggle="modal" data-target=".bs-edit-laptop-modal-lg"></a><span class="fa fa-trash"></span></p></td>
<span class="fa fa-scissors"></span></a></p></td>
            <td class="text-center"><p data-placement="top" data-toggle="tooltip" title="Delete"><a class="btn btn-danger btn-xs" ><span class="fa fa-trash"></span></a></p></td>
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
                <form id="laptop" class="form-horizontal">
                        <div class="col-md-12">
                            <div class="col-md-5">
                                <div class="form-group">
                                    Brand:
                                    <select name="laptop-brand" id="laptop-brand" class="form-control">
                                        <option value="Select brands" title="Select brands" selected disabled>Select brands</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    Processor Type:
                                    <select name="laptop-processor" id="laptop-processor" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    RAM Size:
                                    <select name="laptop-ram-size" id="laptop-ram-size" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group">
                                    Hard Drive Size:
                                    <select name="laptop-storage-capacity" id="laptop-storage-capacity" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    Number of Cores:
                                    <select name="laptop-cpu-cores" id="laptop-cpu-cores" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    Display size (inches):
                                    <select name="laptop-display-size" id="laptop-display-size" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
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
                                    OS:
                                    <select name="laptop-os" id="laptop-os" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    Camera:<br>
                                    <input type="radio" title="laptop camera" name="laptop-camera" value="Yes" id="laptop-camera">&nbsp;Yes
                                    <input type="radio" title="laptop camera" name="laptop-camera" value="No" id="laptop-camera">&nbsp;No
                                </div>
                                <div class="form-group">
                                    Touchscreen:<br>
                                    <input type="radio" title="laptop touchscreen" name="laptop-touchscreen" value="Yes" id="laptop-camera">&nbsp;Yes
                                    <input type="radio" title="laptop touchscreen" name="laptop-touchscreen" value="No" id="laptop-camera">&nbsp;No
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
@endsection