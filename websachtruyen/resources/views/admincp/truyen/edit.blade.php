@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập nhật truyện</div>
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
                    <form method ="POST" action ="{{route('truyen.update',[$truyen->id])}}" enctype='multipart/form-data'>
                    @method('PUT')   
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên truyện</label>
                        <input type="text" class="form-control" name="tentruyen" value= "{{$truyen->tentruyen}}" onkeyup="ChangeToSlug();" id="slug" placeholder=" Nhập tên truyện..." aria-describedby="emailHelp">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug truyện</label>
                        <input type="text" class="form-control" name="slug_truyen" value="{{$truyen->slug_truyen}}" id="convert_slug" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên tác giả</label>
                        <input type="text" class="form-control" name="tacgia" value= "{{$truyen->tacgia}}" placeholder=" Nhập tên tác giả..." aria-describedby="emailHelp">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Tóm tắt truyện</label>
                        <textarea class="form-control" rows="5" style="resize: none" value= "" name="tomtat">{{$truyen->tomtat}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Hình ảnh</label>
                        <input type="file" class="form-control-file" name="hinhanh" value="{{$truyen->hinhanh}}" >
                        <img src="{{asset('uploads/truyen/'.$truyen->hinhanh)}}" height="210", width= "160">
                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Danh mục truyện</label>
                    <select name ="danhmuc" class="custom-select" >
                    @foreach($danhmuc as $key =>$muc)
                        <option {{$muc-> id == $truyen->danhmuc_id ? 'selected' : ''}} value="{{$muc->id}}"> {{$muc->tendanhmuc}} </option>
                    @endforeach
                    </select>
                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Kích hoạt</label>
                    <select name ="kichhoat" class="custom-select">
                    @if($truyen->kichhoat==0)
                        <option selected value="0">Kích hoạt</option>
                        <option value="1">Không kích hoạt</option>
                    @else
                        <option value="0">Kích hoạt</option>
                        <option selected value="1">Không kích hoạt</option>
                    @endif
                    </select>
                    </div>

                    <button type="submit" name="capnhattruyen" class="btn btn-primary">Cập nhật </button>

                    </form>
                        <!-- ////// -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
