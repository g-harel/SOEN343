@extends('layouts.app')
@section('content')
    <div class='jumbotron'>
        <h3>Purchase History</h3>
        
          <div class="row">
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p>Your purchased item was successfully returned.</p>
                </div>
          </div>
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Serial Number</th>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Name, Serial, 100.00$, DATE</td> 
                        <td>
                            <form action="/returnPurchase" method="post">
                            {{ csrf_field() }}
                                <input type="hidden" name="transaction-id" id="transaction-id" value="{{ $unit['id'] }}" />
                                <input type="hidden" name="serial-nb" id="serial-nb" value="{{ $unit['serial'] }}" />  
                                
                                <!-- Trigger the modal with a button -->
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Return</button>

                                <!-- Modal -->
                                <div id="myModal" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Modal Header</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p>Some text in the modal.</p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" name="submit" class="btn btn-default">Return</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                            </form>
                        </td>
                    </tr>
        </table>
    </div>
@endsection
