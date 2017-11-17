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
            <h1>Your shopping cart is empty. Please <a href="/login">Sign in</a> and try again!</h1>
        @else
            <div class="row">
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <table class="table table-hover">
                        <tbody>
                        @foreach($cart as $unit)
                            <tr>
                                <td class="col-sm-8 col-md-6">
                                    <div class="media">
                                        <div class="media-body" style="padding-left:4px;">
                                            <h4 class="media-heading">{{$unit['serial']}} </h4>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>
                                <button type="button" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                    <a href="/view" style="color:white">Continue Shopping</a>
                                </button>
                            </td>


                            <td>
                                <form action="items/monitor/purchase" method="post">
                                    {{ csrf_field() }}
                                    @for($i = 0; $i < count($cart);$i++)
                                        <input type="hidden"  name="serial{{$i}}" value="{{$cart[$i]['serial']}}" />
                                        <input type="hidden"  name="item_id{{$i}}" value="{{$cart[$i]['item_id']}}" />
                                    @endfor
                                <input type="submit" class="btn btn-success" value="checkout"/>

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