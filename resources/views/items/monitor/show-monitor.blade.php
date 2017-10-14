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
                <td scope="row" id="1">1</td>
                <td>Dell</td>
                <td>1000</td>
                <td>43</td>
                <td>34</td>
                <td>5</td>
                <td class="text-center">
                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                        <a class="btn btn-primary btn-xs edit-monitor-link" href="" data-toggle="modal" data-target=".bs-edit-monitor-modal-lg">
                            <span class="fa fa-scissors"></span>
                        </a>
                    </p>
                </td>
                <td class="text-center"><p data-placement="top" data-toggle="tooltip" title="Delete"><a class="btn btn-danger btn-xs" ><span class="fa fa-trash"></span></a></p></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="modal fade bs-edit-monitor-modal-lg" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editing Monitor</h4>
                </div>
                <div class="modal-body" id="edit-monitor-form-body">
                    <form id="monitor-form" class="form-horizontal" action=""></form>
                </div>
            </div>
        </div>
    </div>

@endsection