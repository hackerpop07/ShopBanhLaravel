@extends('master')
@section('content')
    <div class="container">
        <div id="content">
            <div class="row">
                <div class="col-sm-9">

                    <div class="row">
                        <div class="col-sm-4">
                            <img src="storage/source//image/product/{{$product->image}}" alt="">
                        </div>
                        <div class="col-sm-8">
                            <div class="single-item-body">
                                <h2>{{$product->name}}</h2>
                                <br>
                                <p class="single-item-price">
                                    @if($product->promotion_price==0)
                                        <span class="flash-sale">{{number_format($product->unit_price)}} đồng</span>
                                    @else
                                        <span
                                            class="flash-del">{{number_format($product->unit_price)}} đồng</span>
                                        <span
                                            class="flash-sale">{{number_format($product->promotion_price)}} đồng</span>
                                    @endif
                                </p>
                            </div>

                            <div class="clearfix"></div>
                            <div class="space20">&nbsp;</div>

                            <div class="space20">&nbsp;</div>

                            <div class="single-item-options">
                                <a class="add-to-cart" href="{{route('shopping-cart.getAdCart',$product->id)}}"><i
                                        class="fa fa-shopping-cart"></i></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="space40">&nbsp;</div>
                    <div class="woocommerce-tabs">
                        <ul class="tabs">
                            <li><a href="#tab-description">Mô tả</a></li>
                            {{--                            <li><a href="#tab-reviews">Reviews (0)</a></li>--}}
                        </ul>

                        <div class="panel" id="tab-description">
                            <p>{{$product->description}}</p>
                        </div>
                        <div class="panel" id="tab-reviews">
                            <p>No Reviews</p>
                        </div>
                    </div>
                    <div class="space50">&nbsp;</div>
                    <div class="beta-products-list">
                        <h4>Related Products</h4>

                        <div class="row">
                            @foreach($products as $product)
                                <div class="col-sm-3">
                                    <div class="single-item">
                                        <div class="ribbon-wrapper">
                                            @if($product->promotion_price != 0)
                                                <div class="ribbon sale">Sale</div>
                                            @endif
                                        </div>

                                        <div class="single-item-header">
                                            <a href="{{route('page.getProductDetail',$product->id)}}"><img
                                                    src="storage/source/image/product/{{$product->image}}"
                                                    height="250px" alt=""></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{$product->name}}</p>
                                            <p class="single-item-price" style="font-size: 18px">
                                                @if($product->promotion_price==0)
                                                    <span class="flash-sale">{{number_format($product->unit_price)}} đồng</span>
                                                @else
                                                    <span
                                                        class="flash-del">{{number_format($product->unit_price)}} đồng</span>
                                                    <span
                                                        class="flash-sale">{{number_format($product->promotion_price)}} đồng</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left"
                                               href="{{route('shopping-cart.getAdCart',$product->id)}}"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary"
                                               href="{{route('page.getProductDetail',$product->id)}}"> Details <i
                                                    class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> <!-- .beta-products-list -->
                    <div class="row">{{$products->links()}}</div>
                </div>
            </div>
        </div> <!-- #content -->
    </div> <!-- .container -->

@endsection
