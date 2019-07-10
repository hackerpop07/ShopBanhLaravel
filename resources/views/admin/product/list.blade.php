@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>List</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <form action="{{route('admin.product.search')}}" method="POST">
                    @csrf
                    <li class="sidebar-search col-md-3" style="list-style: none; float: right; margin-bottom: 10px;">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </li>
                </form>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr class="odd gradeX" style="text-align: center !important;">
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Loại Bánh</th>
                        <th>Mô Tả</th>
                        <th>Giá</th>
                        <th>Giá Sale</th>
                        <th>Đóng gói</th>
                        <th>Sản Phẩm Mới</th>
                        <th>Ảnh</th>
                        <th>Xóa</th>
                        <th>Chỉnh Sửa</th>
                    </tr>
                    </thead>
                    @foreach($products as $key => $value)
                        <tbody>
                        <tr class="odd gradeX" align="center">
                            <td>{{++$key}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->product_type->name}}</td>
                            <td>{{$value->description}}</td>
                            <td>{{number_format($value->unit_price)}}</td>
                            <td>{{number_format($value->promotion_price)}}</td>
                            <td>{{$value->unit}}</td>
                            @if($value->new!=0)
                                <td>New</td>
                                @else
                                <td></td>
                            @endif

                            <td><img src="storage/source/image/product/{{$value->image}}" style="height: 50px"></td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i>
                                <a href="{{route('admin.product.destroy',$value->id)}}"
                                   onclick="return confirm('Bạn có muốn xóa không?')">
                                    Delete</a>
                            </td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                    href="{{route('admin.product.edit',$value->id)}}">Edit</a></td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
            <div class="row">{{$products->links()}}</div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
