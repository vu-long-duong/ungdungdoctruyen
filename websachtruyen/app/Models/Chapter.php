<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    public $timestamps=false;// bỏ thuộc tính thời gian khi tạo hoặc cạp nhật dữ liệu
    protected $fillable=[
        'truyen_id','tieude','tomtat','noidung','slug_chapter','kichhoat'
    ];
    protected $primarykey='id';//khoá chính
    protected $table= 'chapter';// tên bảng

    public function truyen(){
        return $this-> belongsTo('App\Models\Truyen','truyen_id','id');
    }

}
