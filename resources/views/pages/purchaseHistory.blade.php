@extends('layouts.app')
@section('content')
    <div class='jumbotron'>
        <h3>Purchase History</h3>
        <table>
            <tr>
                <th>Product</th>
                <th>Serial Number</th>
                <td></td>
            </tr>
            <tr>
                <td>item</td>
                <td><a class="btn" href="#">Return</a>
            </tr>
        </table>
        <hr>
        <h3>Returns</h3>
        <table>
            <tr>
                <th>Product</th>
                <th>Serial Number</th>
            </tr>
            <tr>
                <td>item</td>
            </tr>
        </table>
    </div>
@endsection