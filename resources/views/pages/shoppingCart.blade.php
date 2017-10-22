@extends('layouts.app')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn').click(DeleteRow);
    });

    function DeleteRow()
    { 
        $(this).parents('tr').first().remove();
    }
</script>
@section('content')
<div class="container">
<div class="row">
    <div class="col-sm-12 col-md-10 col-md-offset-1">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Total</th>
                    <th class="product-removal"> </th>
                </tr>
            </thead>
            <tbody>
                <tr id="product-1">
                    <td class="col-sm-8 col-md-6">
                    <div class="media">
                        <a class="thumbnail pull-left" href="#"><i class="fa fa-laptop fa-5x"></i></a>
                        <div class="media-body" style="padding-left:4px;">
                            <h4 class="media-heading"><a href="#">Macbook air 13"</a></h4>
                            <h5 class="media-heading">Apple</h5>
                        </div>
                    </div></td>
                    <td class="col-sm-1 col-md-1" style="text-align: center">
                    <input type="number" class="form-control" id="exampleInputEmail1" value="2" min="1">
                    </td>
                    <td class="col-sm-1 col-md-1 text-center"><strong>$1000.00</strong></td>
                    <td class="col-sm-1 col-md-1 text-center"><strong>$2000.00</strong></td>
                    <td class="col-sm-1 col-md-1">
                    <div class="product-removal">
                        <button type="button" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </button>
                    </div>
                    </td>
                    </tr>
                <tr>
                    <td class="cold-sm-8 col-md-6">
                    <div class="media">
                        <a class="thumbnail pull-left" href="#"><i class="fa fa-tv fa-5x"></i></a>
                        <div class="media-body" style="padding-left:4px;">
                            <h4 class="media-heading"><a href="#">Flat Screen Tv 64"</a></h4>
                            <h5 class="media-heading">Samsung</h5>
                        </div>
                    </div></td>
                    <td class="col-md-1" style="text-align: center">
                    <input type="number" class="form-control" id="exampleInputEmail1" min="1">
                    </td>
                    <td class="col-md-1 text-center"><strong>$2500.00</strong></td>
                    <td class="col-md-1 text-center"><strong>$2500.00</strong></td>
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
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h3>Total</h3></td>
                    <td class="text-right"><h3><strong>$4500.00</strong></h3></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td>
                    <button type="button" class="btn btn-primary">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                    </button></td>
                    <td>
                    <button type="button" class="btn btn-success">
                        Checkout <span class="glyphicon glyphicon-play"></span>
                    </button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection