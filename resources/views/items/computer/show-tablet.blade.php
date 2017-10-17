@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/items">Items</a></li>
        <li>Computer</li>
        <li class="active">Tablet</li>
    </ol>
<div class="col-lg-9">
    <p><button class="btn btn-success create-new-items">Add new</button></p>
    <table class="table table-bordered table-responsive">
        <thead>
        <tr>
            <th>#</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Processor</th>
            <th>Ram size</th>
            <th>Weight</th>
            <th>CPU cores</th>
            <th>HDD size</th>
            <th>Display Size (inch.)</th>
            <th>Height (cm)</th>
            <th>Width (cm)</th>
            <th>Thickness (cm)</th>
            <th>Battery</th>
            <th>OS</th>
            <th>Camera</th>
            <th>Touchscreen</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            {{-- please print the id from database here  --}}
            <td scope="row" id="31">31</td>
            <td>Dell</td>
            <td>400</td>
            <td>43</td>
            <td>Intel</td>
            <td>6</td>
            <td>1</td>
            <td>4</td>
            <td>16</td>
            <td>7</td>
            <td>2</td>
            <td>3</td>
            <td>6</td>
            <td>Mac</td>
            <td>Google Android</td>
            <td>Yes</td>
            <td>Yes</td>
            <td class="text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="edit-tablet-link" href="" data-toggle="modal" data-target=".bs-edit-tablet-modal-lg">
                                Edit
                            </a>
                        </li>
                        <li>
                            <a class="del-tablet-link" href="" data-qty="43" data-id="31" data-toggle="modal" data-target="#delTabletLink">
                                Delete/Update Qty
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
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
            <div class="modal-body">
                <form id="tablet"  class="form-horizontal"></form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delTabletLink" tabindex="-1" role="dialog" aria-labelledby="delTabletLink">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Removing tablet item(s)</h4>
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