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
                <form action="{{route('admin.category.search')}}" method="POST">
                    @csrf
                    <li class="sidebar-search col-md-3" style="list-style: none; float: right; margin-bottom: 10px;">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" name="keyword" placeholder="Search...">
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
                    <tr align="center">
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Mô Tả</th>
                        <th>Ảnh</th>
                        <th>Xóa</th>
                        <th>Chỉnh Sửa</th>
                    </tr>
                    </thead>
                    @foreach($category as $key => $value)
                        <tbody>
                        <tr class="odd gradeX" align="center">
                            <td>{{++$key}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->description}}</td>
                            <td><img src="storage/source/image/product/{{$value->image}}" style="height: 50px"></td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i>
                                <a href="{{route('admin.category.destroy',$value->id)}}"
                                   onclick="return confirm('Bạn sẽ xóa cả các bánh nằm trong danh mục này!')">
                                    Delete</a>
                            </td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                    href="{{route('admin.category.edit',$value->id)}}">Edit</a></td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
            <div class="row">{{$category->links()}}</div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
