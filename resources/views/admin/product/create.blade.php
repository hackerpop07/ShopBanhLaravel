@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tên Bánh</label>
                            <input class="form-control" name="name" value="{{ old('name') }}"/>
                        </div>

                        @error('name')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror

                        <div class="form-group">
                            <label>Loại Bánh</label>
                            <select class="form-control" name="id_type">
                                @foreach($category as $key => $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('id_type')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror

                        <div class="form-group">
                            <label>Giá Bán</label>
                            <input class="form-control" name="unit_price" value="{{ old('unit_price') }}"/>
                        </div>
                        @error('unit_price')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror

                        <div class="form-group">
                            <label>Giá Sale</label>
                            <input class="form-control" name="promotion_price" value="{{ old('promotion_price') }}"/>
                        </div>
                        @error('promotion_price')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror

                        <div class="form-group">
                            <label>Đóng gói</label>
                            <select class="form-control" name="unit">
                                <option>Hộp</option>
                                <option>Cái</option>
                            </select>
                        </div>
                        @error('promotion_price')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror

                        <div class="form-group">
                            <label>Sản phẩm mới</label>
                            <select class="form-control" name="new">
                                <option value="1">Có</option>
                                <option value="0">Không</option>
                            </select>
                        </div>
                        @error('promotion_price')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror

                        <div class="form-group">
                            <label>Ảnh</label>
                            <input type="file"
                                   onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
                                   class="form-control-file"
                                   name="image"
                            >
                            <img id="image" src=""
                                 style="height: 50px"/>
                        </div>
                        @error('image')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror

                        <div class="form-group">
                            <label>Mô Tả</label>
                            <textarea class="form-control" rows="3"
                                      name="description">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror

                        <button type="submit" class="btn btn-default">Thêm Mới</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
