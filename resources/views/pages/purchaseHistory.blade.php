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
            <!-- still need to display purchase name -->
            @if(isset($_SESSION)  && !empty($_SESSION))
                @foreach($units as $unit)
                    <tr>
                        <td>{{ $unit['name'] }}, {{ $unit['serial'] }},{{ $unit['price'] }}$, purchased on {{ $unit['purchased_date'] }}</td>
                        <td><a class="btn" href="#">Return</a>
                    </tr>
                @endforeach
            @endif
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