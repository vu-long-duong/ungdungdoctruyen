@extends('../welcome')
 
@section('content')      
        <!--------------------Sách mới--------------- -->
            <div class="container"> 
            <h3></h3>
                
            <div class="album py-5 bg-light">
            <div class="container">

            <div class="row">
                @php
                 $count=count($truyen);
                @endphp
            @if($count==0)
            <div class="col-md-3">
                <p>Truyện đang cập nhật.....</p>
            </div>
            @else
                @foreach($truyen as $key => $value)
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
            @endif
            </div>
            <a href="" class="btn btn-success btn-sm">Xem tất cả</a>
            </div>
            </div>
        <!--End Sách mới -->


@endsection