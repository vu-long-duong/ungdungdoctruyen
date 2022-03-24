@extends('../welcome')
 
@section('content')  
<div class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Mới nhất</a></li>
        <li class="breadcrumb-item"><a href="#">Bán chạy</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <h4>{{$chapter->truyen->tentruyen}}</h4>
            <p>Chương hiện tại :{{$chapter->tieude}}</p>
            <div class="col-md-5"> 
                          
                <div class="form-group">
                        
                    <label for="exampleInputEmail1">Chọn chương</label>
                    <div class="col">
                    <a class="btn btn-primary" href="{{url('xem-chapter/'.$previous_chapter)}}">Tập trước</a> 
                    <select name="select-chapter" class="custom-select select-chapter">
                        @foreach($all_chapter as $key => $chap)
                        <option value="{{url('xem-chapter/'.$chap -> slug_chapter)}}">{{$chap->tieude}}</option>
                        @endforeach
                    </select>      
                    <p class="mt-2"><a class="btn btn-primary" {{$chapter->id == $max_id ? 'isDisable':''}} href="{{url('xem-chapter/'.$next_chapter)}}">Tập sau</a>  </p>
                    </div>            
                </div>
                
            </div>
            <div class="noidungchuong">                
                {!! $chapter->noidung!!}
                    <div class="col-md-5">                
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chọn chương</label>
                            <select name="select-chapter" class="custom-select select-chapter">
                                @foreach($all_chapter as $key => $chap)
                                <option value="{{url('xem-chapter/'.$chap -> slug_chapter)}}">{{$chap->tieude}}</option>
                                @endforeach
                            </select>                    
                        </div>                        
                    </div>
                <h3>Lưu và chia sẻ truyện: </h3>
                <a href=""><i class="fab fa-facebook"></i></a>
                <a href=""><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection