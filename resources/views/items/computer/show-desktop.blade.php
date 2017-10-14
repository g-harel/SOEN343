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
            <div class="modal-body" id="edit-desktop-form-body">
                <form id="desktop" class="form-horizontal"></form>
            </div>
        </div>
    </div>
</div>

@endsection