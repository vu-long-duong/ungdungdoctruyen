<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen extends Model
{
    use HasFactory;

    public $timestamps=false;// bỏ thuộc tính thời gian khi tạo hoặc cạp nhật dữ liệu
    protected $fillable=[
        'tentruyen','tacgia','tomtat','slug_truyen','danhmuc_id','hinhanh','kichhoat'
    ];
    protected $primarykey='id';//khoá chính
    protected $table= 'truyen';// tên bảng
    public function danhmuctruyen(){
        return $this-> belongsTo('App\Models\DanhmucTruyen','danhmuc_id','id');
    }

    public function chapter(){
        return $this-> hasMany('App\Models\Chapter','truyen_id', 'id');
    }
}
