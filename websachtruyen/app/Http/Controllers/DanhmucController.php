<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;

class DanhmucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $danhmuctruyen = DanhmucTruyen::orderBy('id','DESC')->get();
        return view('admincp.danhmuctruyen.index')->with(compact('danhmuctruyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admincp.danhmuctruyen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data=$request->validate([
            'tendanhmuc'=> 'required|unique:danhmuc|max:255',
            'mota' => 'required|max:255',
            'slug_danhmuc' => 'required|max:255',
            'kichhoat' => 'required',
        ],
        [
            'tendanhmuc.unique'=> 'Tên danh mục đã tồn tại',
            'tendanhmuc.required'=> 'Tên danh mục phải có chứ',
            'mota.required' => 'Mô tả danh mục phải có nhé',
            'slug_danhmuc.required' =>  'Slug  danh mục phải có nhé',
        ]);

        $danhmuctruyen= new DanhmucTruyen();
        $danhmuctruyen->tendanhmuc=$data['tendanhmuc'];
        $danhmuctruyen->mota=$data['mota'];
        $danhmuctruyen->slug_danhmuc=$data['slug_danhmuc'];
        $danhmuctruyen->kichhoat=$data['kichhoat'];
        $danhmuctruyen->save();
        return redirect()->back()->with('status','Thêm danh mục thành công');
        //trả về chính cái trang mà mình đã gửi dữ liệu vào và kèm thông báo
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $danhmuc=DanhmucTruyen::find($id);
        return view('admincp.danhmuctruyen.edit')->with(compact('danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data=$request->validate([
            'tendanhmuc'=> 'required|max:255',
            'mota' => 'required|max:255',
            'slug_danhmuc' => 'required|max:255',
            'kichhoat' => 'required',
        ],
        [
            'tendanhmuc.required'=> 'Tên danh mục phải có chứ',
            'mota.required' => 'Mô tả danh mục phải có nhé',
            'slug_danhmuc.required' =>  'Slug  danh mục phải có nhé',
        ]);

        $danhmuctruyen= DanhmucTruyen::find($id);
        $danhmuctruyen->tendanhmuc=$data['tendanhmuc'];
        $danhmuctruyen->mota=$data['mota'];
        $danhmuctruyen->slug_danhmuc=$data['slug_danhmuc'];
        $danhmuctruyen->kichhoat=$data['kichhoat'];
        $danhmuctruyen->save();
        return redirect()->back()->with('status','Cập nhật danh mục thành công');
        //trả về chính cái trang mà mình đã gửi dữ liệu vào và kèm thông báo
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DanhmucTruyen::find($id)->delete();
        return redirect()->back()->with('status','Xoá danh mục thành công');
    }
}
