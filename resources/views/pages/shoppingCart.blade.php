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
    @if(!(isset($_SESSION))  ||  empty($_SESSION))
        <h1>Your shopping cart is empty. Please Sign in and try again!</h1>
    @else
<div class="row">
    <div class="col-sm-12 col-md-10 col-md-offset-1">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Total</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                <td class="col-sm-8 col-md-6">
                    <div class="media">
                        <a class="thumbnail pull-left" href="#"><i class="fa fa-laptop fa-5x"></i></a>
                        <div class="media-body" style="padding-left:4px;">
                            <h4 class="media-heading"><a href="#">Macbook air 13"</a></h4>
                            <h5 class="media-heading">Apple</h5>
                        </div>
                    </div>
                </td>
                    <td class="col-sm-1 col-md-1" style="text-align: center">
                        <input type="number" class="quantity form-control" value="1" min="1">
                    </td>
                    <td class="col-sm-1 col-md-1 text-center"><strong>$<span class="price">1000</span></strong></td>
                    <td class="col-sm-1 col-md-1 text-center"><strong>$<span class="total">1000</span></strong></td>
                    <td class="col-sm-1 col-md-1">
                        <button type="button" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </button>
                    </td>
                    </tr>
                    <td class="cold-sm-8 col-md-6">
                    <div class="media">
                        <a class="thumbnail pull-left" href="#"><i class="fa fa-tv fa-5x"></i></a>
                        <div class="media-body" style="padding-left:4px;">
                            <h4 class="media-heading"><a href="#">Flat Screen Tv 64"</a></h4>
                            <h5 class="media-heading">Samsung</h5>
                        </div>
                    </div>
                </td>
                    <td class="col-md-1" style="text-align: center">
                        <input type="number" class="quantity form-control" value="1" min="1">
                    </td>
                    <td class="col-md-1 text-center"><strong>$<span class="price">2500</span></strong></td>
                    <td class="col-md-1 text-center"><strong>$<span class="total">2500</span></strong></td>
                    <td class="col-md-1">
                        <button type="button" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h3>Total</h3></td>
                    <td class="text-right"><h3><strong>$<span class="grand-total">3500</span></strong></h3></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td>
                        <button type="button" class="btn btn-primary">
                            <span class="glyphicon glyphicon-shopping-cart"></span><a href="/items" style="color:white">Continue Shopping</a>

                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success">
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
    @endif
</div>
@endsection