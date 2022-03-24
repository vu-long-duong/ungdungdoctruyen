@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập nhật Chapter</div>
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
                    <form method ="POST" action ="{{route('chapter.update',[$chapter->id])}}" enctype='multipart/form-data'>
                    @method('PUT') 
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên chapter</label>
                        <input type="text" class="form-control" name="tieude" value= "{{$chapter->tieude}}" onkeyup="ChangeToSlug();" id="slug" placeholder=" Nhập tên Chapter..." aria-describedby="emailHelp">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug chapter</label>
                        <input type="text" class="form-control" name="slug_chapter" value="$chapter->slug_chapter" id="convert_slug" aria-describedby="emailHelp">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Tóm tắt Chapter</label>
                        <textarea class="form-control" rows="5" style="resize: none" value= "" name="tomtat">{{$chapter->tomtat}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nội dung</label>
                        <textarea class="form-control" id="noidung_chapter" rows="5" style="resize: none" value= "" name="noidung">{{$chapter->noidung}}</textarea>
                    </div>


                    <div class="form-group">
                    <label for="exampleInputEmail1">Truyện</label>
                    <select name ="truyen_id" class="custom-select" >
                    @foreach($truyen as $key => $value) 
                        <option {{$chapter->truyen_id==$value->id ? 'selected' : ''}} value="{{$value->id}}">{{$value->tentruyen}}</option>
                    @endforeach
                    </select>
                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Kích hoạt</label>
                    <select name ="kichhoat" class="custom-select">
                    @if($value->kichhoat==0)
                        <option selected value="0">Kích hoạt</option>
                        <option value="1">Không kích hoạt</option>
                    @else
                        <option value="0">Kích hoạt</option>
                        <option selected value="1">Không kích hoạt</option>
                    @endif
                    </select>
                    </div>

                    <button type="submit" name="capnhatchapter" class="btn btn-primary">Cập nhật</button>

                    </form>
                        <!-- ////// -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
