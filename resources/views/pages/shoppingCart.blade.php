@extends('layouts.app')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    const updateTotal = () => {
        let total = 0;
        $('.total').each(() => {
            total += parseInt($(this).text(), 10);
        });
        $('.grand-total').text(total);
    };

    $(document).ready(() => {
        $('.btn').click(() => {
            $(this).parents('tr').first().remove();
            $(this).parents('.quantity').val('0');
            updateTotal();
        });

        $('.quantity').change(() => {
            const parent = $(this.closest('tr'));
            parent.find('.total').text($(this).val() * parseInt(parent.find('.price').text(), 10));
            updateTotal();
        });
    });
</script>
@section('content')
    <div class="container">
        @if(Session::has('itemSuccessfullyRemoved'))
            <div class="row">
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p>This item was successfully removed from your cart.</p>
                </div>
            </div>
        @endif
        @if(empty($cart))
            <h1>Your shopping cart is empty!</h1>
        @if(!empty($itemSuccessfullyPurchased))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>Units were successfully purchased!</p>
            </div>
        @endif
        @if(empty($cart) && !empty($_SESSION['currentLoggedInId']))
            <div class="row">
                <div class="text-center">
                    <h1>Your shopping cart is empty!</h1>
                    <button type="button" class="btn btn-primary">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        <a href="/view" style="color:white">Continue Shopping</a>
                    </button>
                </div>
            </div>
        @elseif (empty($cart) && empty($_SESSION['currentLoggedInId']))
                <div class="row">
                    <div class="text-center">
                        <h1>Your shopping cart is empty! Please <a href="/login">Sign</a> in to view your cart.</h1>
                    </div>
                </div>
            @endif
        @if(!empty($cart) && !empty($_SESSION['currentLoggedInId']) )
            <div class="row">
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <table class="table table-hover">
                        <thead>
                            <th>Product</th>
                            <th>Description</th>
                            <th class="text-center">Price</th>
                        </thead>
                        <tbody>
                        @foreach($cart as $unit)
                            <tr>
                                <td class="col-sm-6 col-md-4">
                                    <div class="media">
                                        @if($unit['category'] == 'laptop')
                                            <a class="thumbnail pull-left"><i class="fa fa-laptop fa-5x"></i></a>
                                        @endif
                                        @if($unit['category'] == 'desktop')
                                            <a class="thumbnail pull-left"><i class="fa fa-desktop fa-5x"></i></a>
                                            <div class="media-body" style="padding-left:4px;">
                                            </div>
                                        @endif
                                        @if($unit['category'] == 'tablet')
                                            <a class="thumbnail pull-left"><i class="fa fa-tablet fa-5x"></i></a>
                                            <div class="media-body" style="padding-left:4px;">
                                            </div>
                                        @endif
                                        @if($unit['category'] == 'monitor')
                                            <a class="thumbnail pull-left"><i class="fa fa-tv fa-5x"></i></a>
                                            <div class="media-body" style="padding-left:4px;">
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-left">
                                    <div class="media-body" style="padding-left:4px;">
                                        <h4 class="media-heading">{{$unit['brand']}} {{$unit['category']}}</h4>
                                        <h4 class="media-heading">Serial:{{$unit['serial']}}</h4>
                                    </div>
                                </td>
                                <td class="col-sm-1 col-md-1 text-center"><strong>$<span
                                                class="price">{{$unit['price']}}</span></strong>
                                </td>
                                <td class="col-sm-1 col-md-1">
                                    <form action="/returnPurchase" method="post">
                                        <input type="hidden" name="transaction-id" id="transaction-id" value="{{$_SESSION['session_id']}}" />
                                        <input type="hidden" name="serial-nb" id="serial-nb" value="{{ $unit['serial'] }}" />
                                        <input type="submit" class="btn btn-danger" value="Remove" name="remove-from-cart">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><h3>Total: </h3></td>
                            <td>&nbsp;</td>
                            <td><h3>${{$total}}</h3></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                    <a href="/view" style="color:white">Continue Shopping</a>
                                </button>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>
                                <form action="/checkout" method="post" >
                                    {{ csrf_field() }}
                                <button type="submit" class="btn btn-success">
                                    Checkout <span class="glyphicon glyphicon-play"></span>
                                </button>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection