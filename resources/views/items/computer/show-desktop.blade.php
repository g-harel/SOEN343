@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/items">Items</a></li>
        <li>Computer</li>
        <li class="active">Desktop</li>
    </ol>
 <div class="col-lg-9">
    <p><button class="btn btn-success create-new-items" >Add new</button></p>
    <table class="table table-bordered table-responsive bg-color-white">
        <thead>
        <tr>
            <th>#</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Quantity</th>
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
        <tr>
            <td scope="row" id="1">1</td>
            <td>Dell</td>
            <td>1055</td>
            <td>20</td>
            <td>Intel</td>
            <td>16</td>
            <td>6</td>
            <td>600</td>
            <td>13.2</td>
            <td>43</td>
            <td>24</td>
            <td>13</td>
            <td class="text-center">
                <p data-placement="top" data-toggle="tooltip" title="Edit">
                    <a class="btn btn-primary btn-xs edit-desktop-link" href="" data-toggle="modal" data-target=".bs-edit-desktop-modal-lg">
                        <span class="fa fa-scissors"></span>
                    </a>
                </p>
            </td>
            <td class="text-center"><p data-placement="top" data-toggle="tooltip" title="Delete"><a class="btn btn-danger btn-xs" ><span class="fa fa-trash"></span></a></p></td>
        </tr>

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
            <form id="desktop" class="form-horizontal">
                <div class="col-md-12">
                    <div class="col-md-5">
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
                            <select name="desktop-processor" id="desktop-processor" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            RAM Size:
                            <select name="desktop-ram-size" id="desktop-ram-size" class="form-control">
                            </select>
                        </div>
                        <div class="form-group">
                            Hard Drive Size:
                            <select name="storage-capacity" id="storage-capacity" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            Number of Cores:
                            <select name="desktop-cpu-cores" id="cpu-cores" class="form-control"></select>
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
                            <input type="text" name="desktop-thickness" id="desktop-thickness" class="form-control">
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

@endsection