@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm truyện</div>
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
                                <!-- Khi có form nào thêm hình ảnh thì thêm     enctype='multipart/form-data'    vào nhé -->
                    <form method ="POST" action ="{{route('truyen.store')}}" enctype='multipart/form-data'>
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên truyện</label>
                        <input type="text" class="form-control" name="tentruyen" value= "{{old('tentruyen')}}" onkeyup="ChangeToSlug();" id="slug" placeholder=" Nhập tên truyện..." aria-describedby="emailHelp">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug truyện</label>
                        <input type="text" class="form-control" name="slug_truyen" value="{{old('slug_truyen')}}" id="convert_slug" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên tác giả</label>
                        <input type="text" class="form-control" name="tacgia" value= "{{old('tacgia')}}" placeholder=" Nhập tên tác giả..." aria-describedby="emailHelp">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Tóm tắt truyện</label>
                        <textarea class="form-control" rows="5" style="resize: none" value= "{{old('tomtat')}}" name="tomtat"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Hình ảnh</label>
                        <input type="file" class="form-control-file" name="hinhanh" value="{{old('hinhanh')}}" >
                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Danh mục truyện</label>
                    <select name ="danhmuc" class="custom-select" >
                    @foreach($danhmuc as $key =>$muc)
                        <option value="{{$muc->id}}">{{$muc->tendanhmuc}}</option>
                    @endforeach
                    </select>
                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Kích hoạt</label>
                    <select name ="kichhoat" class="custom-select">
                        <option value="0">Kích hoạt</option>
                        <option value="1">Không kích hoạt</option>
                    </select>
                    </div>

                    <button type="submit" name="themtruyen" class="btn btn-primary">Thêm</button>

                    </form>
                        <!-- ////// -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
