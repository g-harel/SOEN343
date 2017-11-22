@extends('layouts.app')
@section('content')
    @if(isset($itemSuccessfullyReturned) && $itemSuccessfullyReturned==true)
        <div class="row">
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>Your purchased item was successfully returned.</p>
            </div>
        </div>
    @endif
    <div class='jumbotron'>
        <h3>Purchase History</h3>
        <div class="row">
        @if(isset($_SESSION)  && !empty($_SESSION))
            @if(empty($units))
                <p>Your purchase history is empty.</p>
            <!-- still need to display purchase name -->
            @else
                <table>
                    <tr>
                        <th>Serial Number</th>
                        <th>Price</th>
                        <th>Purchase date</th>
                        <td></td>
                    </tr>
                @foreach($units as $unit)
                    <tr>
                        <td style="text-align: left;">{{ $unit['serial'] }}</td>
                        <td style="text-align: left;">{{ $unit['purchased_price'] }}$</td> 
                        <td style="text-align: left;">{{ $unit['purchased_date'] }}</td>
                        <td>
                            <form action="/returnPurchase" method="post">
                            {{ csrf_field() }}
                                <input type="hidden" name="transaction-id" id="transaction-id" value="{{ 42 }}" />
                                <input type="hidden" name="serial-nb" id="serial-nb" value="{{ $unit['serial'] }}" />  
                                <!-- Trigger the modal with a button -->
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" style="margin:12px 12px 0;">Return</button>
                                <!-- modal-->
                                <div id="myModal" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content" style="text-align:left;">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h3 class="modal-title">Return purchased item</h3>
                                      </div>
                                      <div class="modal-body">
                                        <p>Are you sure you want to return this item?</p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" name="submit" class="btn btn-success">Return</button>
                                        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        @endif
        </table>
    </div>
@endsection