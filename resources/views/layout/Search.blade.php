@extends('master')
@section('content')

    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{count($total)}}</p>
                                <div class="clearfix"></div>
                            </div>
                            @foreach($products as $product)
                                <div class="col-sm-3">
                                    <div class="single-item">
                                        <div class="ribbon-wrapper">
                                            @if($product->promotion_price!=0)
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
                                                    <span class="flash-sale">{{number_format($product->promotion_price)}} đồng</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left"
                                               href="{{route('shopping-cart.getAdCart',$product->id)}}"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary"
                                               href="{{route('page.getProductDetail',$product->id)}}">Details <i
                                                    class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> <!-- .beta-products-list -->
                </div>
            </div> <!-- end section with sidebar and main content -->
            <div class="row">{{$products->links()}}</div>

        </div> <!-- .main-content -->
    </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
