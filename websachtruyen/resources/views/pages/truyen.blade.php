@extends('../welcome')

@section('content') 

<!--------------------Sách mới--------------- -->
<div class="container"> 
    <!-- Kiểu Home/Library/Data -->
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Mới nhất</a></li>
        <li class="breadcrumb-item"><a href="#">Bán chạy</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
    </nav>
    <!-- End Kiểu Home/Library/Data -->

                    <!-- --------- -->
    <div class="row">
                <div class="container" >
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-mb-3 ">
                                <img class="card-img-top" src="{{asset('uploads/truyen/'.$truyen->hinhanh)}}"  height="210", width= "160" >
                            </div>
                                <div class="col-mb-9">
                                    <style type="text/css">
                                    .infotruyen{
                                    list-style: none;
                                    }
                                    </style>
                                    <ul>
                                        <li>Truyện: {{$truyen->tentruyen}}</li>
                                        <li> Tác giả: {{$truyen->tacgia}}</li>
                                        <li> Số chương: 300</li>
                                        <li> Số lượt xem: 299</li>
                                        <li> Danh mục truyện: <a href="{{url('danh-muc/'.$truyen->danhmuctruyen->slug_danhmuc)}}">{{$truyen->danhmuctruyen->tendanhmuc}} </a></li>
                                        <li><a href="#">Xem mục lục</a></li>
                                        
                                        @if($chapter_dau)
                                        <li><a href="{{url('xem-chapter/'.$chapter_dau->slug_chapter)}}" class="btn btn-primary">Đọc online</a></li>
                                        @else
                                        <li><a href="{{url('xem-chapter/'.$chapter_dau->slug_chapter)}}" class="btn btn-primary">Hết chapter rồi bro ơi</a></li>
                                        @endif
                                    </ul>
                                </div>
                        </div>
                    </div>
                </div>
                        

                <div class="col-md-12">
                <p> Mô tả:</p>
                    <p>  {{$truyen->tomtat}}  </p>
                </div>




                <div class="container" >                    
                    <h4>Mục lục</h4>
                    <ul class="mucluctruyen">
                        @php
                        $mucluc=count($chapter);
                        @endphp
                    @if($mucluc>0)
                    @foreach($chapter as $key =>$chap)
                        <li><a href="{{url('xem-chapter/'.$chap->slug_chapter)}}"> {{$chap->tieude}}</a> </li>
                        @endforeach
                    
                    @else
                    <div class="col-md-3">
                        <p>Mục lục đang cập nhật.....</p>
                    </div>
                        
                    </ul>
                    @endif
                </div>

                <div class="container" >
                    <h4>Sách cùng danh mục</h4>
                    <div class="row">
                        @foreach($cungdanhmuc as $key => $value)
                        <div class="col-md-3">
                            <div class="card mb-3 box-shadow">
                                
                                <img class="card-img-top" src="{{asset('uploads/truyen/'.$value->hinhanh)}}" >
                                <div class="card-body">
                                    <h5>{{$value->tentruyen}}</h5>
                                    <p class="card-text">{{$value->tomtat}}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                        <a href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                        <a class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i>56799</a>
                                        </div>
                                        <small class="text-muted">9 mins ago</small>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                    
                                  
    </div>
</div>
@endsection