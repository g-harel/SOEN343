@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/items">Items</a></li>
        <li>Computer</li>
        <li class="active">Tablet</li>
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
        <tr>
            <td scope="row">1</td>
            <td>text</td>
            <td>text</td>
            <td>text</td>
            <td>text</td>
            <td>text</td>
            <td>text</td>
            <td>text</td>
            <td>text</td>
            <td>text</td>
            <td>text</td>
            <td>text</td>
            <td>15'</td>
            <td>Mac</td>
            <td>--</td>
            <td>Yes</td>
            <td>No</td>
            <td class="text-center"><p data-placement="top" data-toggle="tooltip" title="Edit"><a class="btn btn-primary btn-xs edit-tablet-link" href="" data-toggle="modal" data-target=".bs-edit-tablet-modal-lg"><span class="fa fa-scissors"></span></a></p></td>
            <td class="text-center"><p data-placement="top" data-toggle="tooltip" title="Delete"><a class="btn btn-danger btn-xs" ><span class="fa fa-trash"></span></a></p></td>
        </tr>

        </tbody>
    </table>
</div>
<div class="modal fade bs-edit-tablet-modal-lg" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editing Tablet</h4>
                </div>
                <form id="tablet"  class="form-horizontal">
                        <div class="col-md-12">
                            <div class="col-md-5">
                                <div class="form-group">
                                    Brand:
                                    <select name="tablet-brand" id="tablet-brand" class="form-control">
                                        <option value="Select brands" title="Select brands" selected disabled>Select brands</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    Processor Type:
                                    <select name="tablet-processor" id="tablet-processor" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    RAM Size:
                                    <select name="tablet-ram-size" id="tablet-ram-size" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group">
                                    Hard Drive Size:
                                    <select name="tablet-storage-capacity" id="tablet-storage-capacity" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    Number of Cores:
                                    <select name="tablet-cpu-cores" id="tablet-cpu-cores" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    Weight (Kg):
                                    <input type="text" name="tablet-weight" id="tablet-weight" class="form-control">
                                </div>
                                <div class="form-group">
                                    Price:
                                    <input type="text" name="tablet-price" id="tablet-price"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    Display size (inches):
                                    <select name="tablet-display-size" id="tablet-display-size" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    Thickness (cm):
                                    <input type="text" name="tablet-thickness" id="tablet-thickness" class="form-control">
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
                                    OS:
                                    <select name="tablet-os" id="tablet-os" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    Camera:<br>
                                    <input type="radio" title="tablet camera" name="tablet-camera" value="Yes" id="tablet-camera">&nbsp;Yes
                                    <input type="radio" title="tablet camera" name="tablet-camera" value="No" id="tablet-camera">&nbsp;No
                                </div>
                                <div class="form-group">
                                    Touchscreen:<br>
                                    <input type="radio" title="tablet touchscreen" name="tablet-touchscreen" value="Yes" id="tablet-camera">&nbsp;Yes
                                    <input type="radio" title="tablet touchscreen" name="tablet-touchscreen" value="No" id="tablet-camera">&nbsp;No
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-lg" name="submit-tablet-form" id="submit-tablet-form">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection