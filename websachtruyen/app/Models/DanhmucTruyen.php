<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhmucTruyen extends Model
{
    use HasFactory;

    public $timestamps=false;// bỏ thuộc tính thời gian khi tạo hoặc cạp nhật dữ liệu
    protected $fillable=[
        'tendanhmuc','mota','kichhoat','slug_danhmuc'
    ];
    protected $primarykey='id';//khoá chính
    protected $table= 'danhmuc';// tên bảng


    public function truyen(){
        return $this-> hasMany('App\Models\Truyen','danhmuc_id', 'id');
    }
}
