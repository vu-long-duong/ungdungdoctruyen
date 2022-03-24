@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập nhật danh mục truyện</div>
                <!-- code hiển thị thông báo lỗi -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- ---- -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                                <!-- Thêm bootstrap form ở đây -->
                                <!-- dùng Post để lưu giữ liệu store là lưu -->
                    <form method ="POST" action ="{{route('danhmuc.update',[$danhmuc->id])}}">
                        <!-- Cứ phần nào có edit thì đều phải "giả phương thức" thêm phương thức PUT nữa  -->
                        @method('PUT')
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên danh mục</label>
                        <input type="text" class="form-control" name="tendanhmuc" value="{{$danhmuc->tendanhmuc}}" onkeyup="ChangeToSlug();" id="slug" placeholder=" Nhập tên danh mục..." aria-describedby="emailHelp">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug danh mục</label>
                        <input type="text" class="form-control" name="slug_danhmuc" value="{{$danhmuc->slug_danhmuc}}"  id="convert_slug" aria-describedby="emailHelp">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Mô tả danh mục</label>
                        <input type="text" class="form-control" name="mota" value="{{$danhmuc->mota}}"  id="exampleInputEmail1" placeholder=" Nhập mô tả danh mục..." aria-describedby="emailHelp">
                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Kích hoạt</label>
                    <select name ="kichhoat" class="custom-select" id="inputGroupSelect01">
                        @if($danhmuc->kichhoat==0)
                        <option selected value="0">Kích hoạt</option>
                        <option value="1">Không kích hoạt</option>
                        @else
                        <option value="0">Kích hoạt</option>
                        <option selected value="1">Không kích hoạt</option>
                        @endif
                    </select>
                    </div>

                    <button type="submit" name="suadanhmuc" class="btn btn-primary">Cập nhật</button>

                    </form>
                        <!-- ////// -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
