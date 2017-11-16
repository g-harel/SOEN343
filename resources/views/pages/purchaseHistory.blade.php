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
                        <td>
                           <form action="/returnPurchase" method="post">
                            <input type="hidden" name="transaction-id" id="transaction-id" value="{{ $unit['id'] }}" />
                            <input type="hidden" name="serial-nb" id="serial-nb" value="{{ $unit['serial'] }}" />   
                            <button type="submit" name="submit" class="btn btn-default">Return</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
@endsection