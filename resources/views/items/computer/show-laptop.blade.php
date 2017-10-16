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
            <td scope="row">1</td>
            <td>Lenovo</td>
            <td>1500</td>
            <td>2</td>
            <td>Intel</td>
            <td>12</td>
            <td>5</td>
            <td>4</td>
            <td>500</td>
            <td>14</td>
            <td>Li-Ion</td>
            <td>Windows 10</td>
            <td>Yes</td>
            <td>No</td>
            <td class="text-center">
                <p data-placement="top" data-toggle="tooltip" title="Edit">
                    <a class="btn btn-primary btn-xs edit-laptop-link" href="" data-toggle="modal" data-target=".bs-edit-laptop-modal-lg">
                        <span class="fa fa-scissors"></span>
                    </a>
                </p>
            </td>
            <td class="text-center">
                <p data-placement="top" data-toggle="tooltip" title="Delete">
                    {{-- please add the quantity at data-qty --}}
                    <a class="btn btn-danger btn-xs" data-qty="2" data-toggle="modal" data-target="#delLaptopLink">
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
                <form id="laptop" class="form-horizontal"></form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delLaptopLink" tabindex="-1" role="dialog" aria-labelledby="delLaptopLink">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete / Update Qty</h4>
            </div>
            <div class="modal-body">
                <p>Please select the number of item to remove from the inventory.</p>
                <form >
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
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