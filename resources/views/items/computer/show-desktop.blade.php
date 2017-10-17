@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/items">Items</a></li>
        <li>Computer</li>
        <li class="active">Desktop</li>
    </ol>
 <div class="col-lg-9">
    <p><button class="btn btn-success create-new-items" >Add new</button></p>
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
        <tr>
            <td scope="row" id="8">8</td>
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
                <p title="Edit">
                    <a class="btn btn-primary btn-xs edit-desktop-link" href="" data-toggle="modal" data-target=".bs-del-desktop-modal">
                        <span class="fa fa-scissors"></span>
                    </a>
                </p>
            </td>
            <td class="text-center">
                <p title="Delete">
                    <a class="btn btn-danger btn-xs" href="" data-qty="20" data-id="8" data-toggle="modal" data-target="#delDesktopLink">
                        <span class="fa fa-trash"></span>
                    </a>
                </p>
            </td>
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
            <div class="modal-body" id="edit-desktop-form-body">
                <form id="desktop" class="form-horizontal"></form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delDesktopLink" tabindex="-1" role="dialog" aria-labelledby="delDesktopLink">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Removing desktop item(s)</h4>
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