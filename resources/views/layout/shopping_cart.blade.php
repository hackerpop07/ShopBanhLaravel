@extends('master')
@section('content')


    <div class="container">
        <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:50%">Sản phẩm</th>
                <th style="width:10%">Giá</th>
                <th style="width:8%">Số Lượng</th>
                <th style="width:22%" class="text-center">Tổng giá</th>
                <th style="width:10%">Chức Năng</th>
            </tr>
            </thead>
            <tbody>
            @if(Session::has('cart'))
                @foreach($cart->items as $product)
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-2 hidden-xs"><img src="storage/source/image/product/{{$product['item']['image']}}"
                                                                     alt="..."
                                                                     class="img-responsive"/></div>
                                <div class="col-sm-10">
                                    <h4 class="nomargin">{{$product['item']['name']}}</h4>
                                    <p>{{$product['item']['description']}}</p>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">@if( $product['item']['promotion_price'] == 0)
                                {{number_format($product['item']['unit_price'])}}
                            @else
                                {{number_format($product['item']['promotion_price'])}}
                            @endif Đồng
                        </td>
                        <form action="{{route('shopping-cart.updateProductIntoCart',$product['item']['id'])}}"
                              method="post">
                            @csrf
                            <td data-th="Quantity">
                                <input type="number" class="form-control text-center" name="qty"
                                       value="{{$product['qty']}}">
                            </td>
                            <td data-th="Subtotal"
                                class="text-center">@if( $product['item']['promotion_price'] == 0)
                                    {{number_format($product['item']['unit_price']*$product['qty'])}}
                                @else
                                    {{number_format($product['item']['promotion_price']*$product['qty'])}}
                                @endif Đồng
                            </td>
                            <td class="actions" data-th="">
                                <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-refresh"></i>
                                </button>
                        </form>
                        <a href="{{route('shopping-cart.removeProductIntoCart',$product['item']['id'])}}">
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                        </a>
                        </td>

                    </tr>
                @endforeach
            @else
                {{'Không có sản phẩm nào'}}
            @endif

            </tbody>
            <tfoot>
            <tr>
                <td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center">
                    <strong> Tổng
                        giá: @if(Session::has('cart')){{number_format(Session::get('cart')->totalPrice)." Đồng"}}
                        @else {{'0'}}
                        @endif
                    </strong>
                </td>
                <td>
                    <a href="{{route('page.checkOut')}}"
                       class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
