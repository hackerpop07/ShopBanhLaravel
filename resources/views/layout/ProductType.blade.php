@extends('master')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Product</h6>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-3">
                        <ul class="aside-menu">
                            @foreach($type as $ty)
                                <li><a href="{{route('page.getProductType',$ty->id)}}">{{$ty->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-sm-9">
                        <div class="beta-products-list">
                            <h4>Product</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{count($product_type)}} sản phẩm</p>
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @foreach($product_type as $product)
                                    <div class="col-sm-4">
                                        <div class="single-item">
                                            @if($product->promotion_price!=0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{route('page.getProductDetail',$product->id)}}"><img
                                                        src="storage/source/image/product/{{$product->image}}"
                                                        alt="" height="250px"></a>
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
                                <div class="space40">&nbsp;</div>
                            </div>
                        </div> <!-- .beta-products-list -->

                        <div class="space50">&nbsp;</div>

                        <div class="beta-products-list">
                            <h4>Sản phẩm khác</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{count($product_khac)}} sản phẩm</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                @foreach($product_khac as $product)
                                    <div class="col-sm-4">
                                        <div class="single-item">
                                            @if($product->promotion_price!=0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{route('page.getProductDetail',$product->id)}}"><img
                                                        src="storage/source/image/product/{{$product->image}}"
                                                        alt="" height="250px"></a>
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
                            <div class="space40">&nbsp;</div>

                        </div> <!-- .beta-products-list -->
                        <div class="row">{{$product_khac->links()}}</div>
                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div> <!-- .container -->

@endsection
