<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;
use App\Models\Chapter;

class IndexController extends Controller
{
    //
    public function home(){
        $danhmuc=DanhmucTruyen::orderBy('id','DESC')->get();
        $truyen=Truyen::orderBy('id','DESC')->where('kichhoat',0)->get();
        return view('pages.home')->with(compact('danhmuc','truyen'));
    }

    public function danhmuc($slug){
        $danhmuc=DanhmucTruyen::orderBy('id','DESC')->get();
        $danhmuc_id=DanhmucTruyen::where('slug_danhmuc',$slug)->first();
        //echo $danhmuc_id->id;// check câu điều kiện danh mục id ở trên
        $truyen=Truyen::orderBy('id','DESC')->where('kichhoat',0)->where('danhmuc_id',$danhmuc_id->id)->get();
        return view('pages.danhmuc')->with(compact('danhmuc','truyen'));
    }

    public function xemtruyen($slug){
        $danhmuc=DanhmucTruyen::orderBy('id','DESC')->get();

        $truyen=Truyen::orderBy('id','DESC')->where('kichhoat',0)->where('slug_truyen',$slug)->first();

        $chapter=Chapter::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->id)->get();

        $chapter_dau=Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->id)->first();
        
        $cungdanhmuc= Truyen::with('danhmuctruyen')->where('danhmuc_id',$truyen->danhmuctruyen->id)->whereNotIn('id',[$truyen->id])->get();

        return view('pages.truyen')->with(compact('danhmuc','truyen','chapter','cungdanhmuc','chapter_dau'));
    }
    public function xemchapter($slug){
        $danhmuc=DanhmucTruyen::orderBy('id','DESC')->get();

        $truyen=Chapter::where('slug_chapter',$slug)->first();

        $chapter=Chapter::with('truyen')->where('slug_chapter',$slug)->where('truyen_id',$truyen->truyen_id)->first();
        
        $next_chapter=Chapter::where('truyen_id',$truyen->truyen_id)->where('id','>',$chapter->id)->min('slug_chapter');

        $previous_chapter=Chapter::where('truyen_id',$truyen->truyen_id)->where('id','<',$chapter->id)->max('slug_chapter');

        $max_id=Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','DESC')->first();
        
        $min_id=Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','ASC')->first();

        $all_chapter=Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->truyen_id)->get();

        return view('pages.chapter')->with(compact('danhmuc','chapter','truyen','all_chapter','previous_chapter','next_chapter','max_id','min_id'));


    }

}
