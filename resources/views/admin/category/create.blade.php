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
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tên Loại Bánh</label>
                            <input class="form-control" name="name" value="{{ old('name') }}"/>
                        </div>
                        @error('name')
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
                            <label>Category Description</label>
                            <textarea class="form-control" rows="3"
                                      name="description">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror

                        <button type="submit" class="btn btn-default">Category Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
