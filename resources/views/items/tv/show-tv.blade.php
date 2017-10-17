@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/items">Items</a></li>
        <li>TVs</li>
    </ol>

    {{-- not for now --}}
    {{--
    <div class="row margin-btm">
        <div class="col-lg-3">
        <span class="list-group-item">
                <span class="badge">124</span>Smart
            </span>
        </div>
        <div class="col-lg-3">
        <span class="list-group-item">
                <span class="badge">124</span>3D
            </span>
        </div>
        <div class="col-lg-3">
        <span class="list-group-item">
                <span class="badge">124</span>HD
        </span>
        </div>
        <div class="col-lg-3">
        <span class="list-group-item">
                <span class="badge">124</span>LED
        </span>
        </div>
    </div>
    --}}

    <p><a href="../create" class="btn btn-success">Add new</a></p>

    <table class="table table-bordered table-responsive">
        <thead>
        <tr>
            <th>#</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Height (cm)</th>
            <th>Width (cm)</th>
            <th>Thickness (cm)</th>
            <th>Weight (kg)</th>
            <th>Type</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td scope="row" id="1">1</td>
            <td>Sony</td>
            <td>$1200</td>
            <td>109</td>
            <td>text</td>
            <td>text</td>
            <td>text</td>
            <td>text</td>
            <td>LED</td>
            <td class="text-center"><p title="Edit"><a class="btn btn-primary btn-xs" href="#"><span class="fa fa-scissors"></span></a></p></td>
            <td class="text-center"><p title="Delete"><a class="btn btn-danger btn-xs" ><span class="fa fa-trash"></span></a></p></td>
        </tr>
        </tbody>
    </table>



@endsection