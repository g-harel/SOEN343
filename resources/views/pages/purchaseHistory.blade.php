@extends('layouts.app')
@section('content')
    <div class='jumbotron'>
        <h3>Purchase History</h3>
        @if(isset($_SESSION)  && !empty($_SESSION))
            @if(empty($units))
                <p>Your purchase history is empty.</p>
            <!-- still need to display purchase name -->
            @else
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Serial Number</th>
                        <td></td>
                    </tr>
                @foreach($units as $unit)
                    <tr>
                        <td>{{ $unit['name'] }}, {{ $unit['serial'] }},{{ $unit['price'] }}$, purchased on {{ $unit['purchased_date'] }}</td> 
                        <td>
                            <form action="/returnPurchase" method="post">
                            {{ csrf_field() }}
                                <input type="hidden" name="transaction-id" id="transaction-id" value="{{ $unit['id'] }}" />
                                <input type="hidden" name="serial-nb" id="serial-nb" value="{{ $unit['serial'] }}" />   
                                <button type="submit" name="submit" class="btn btn-default">Return</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        @endif
        </table>
    </div>
@endsection
