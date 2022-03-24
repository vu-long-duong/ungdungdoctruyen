<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Truyen;
use App\Models\Chapter;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $chapter= Chapter::with('truyen')->orderBy('id','DESC')->get();
        //dd($chapter);
        return view('admincp.chapter.index')->with(compact('chapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $truyen=Truyen::orderBy('id','DESC')->get();
        return view('admincp.chapter.create')->with(compact('truyen'));
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
            'tieude'=> 'required|unique:chapter|max:255',
            'tomtat' => 'required',
            'noidung' => 'required',
            'slug_chapter' => 'required|max:255',
            'kichhoat' => 'required',
            'truyen_id' => 'required',
            
        ],

        [
            'tieude.unique' => 'Tiêu đề đã có rồi, tên khác đê',
            'tieude.required'=> 'Tiêu đề chapter phải có chứ',
            'noidung.required'=> 'Nội dung phải có chứ',
            'tomtat.required' => 'Tóm tắt truyện đã có đâu, thêm vào đê',
            'slug_chapter.required' =>  'Slug truyện phải có nhé',
        ]);

        $chapter= new Chapter();;
        $chapter->tieude=$data['tieude'];
        $chapter->tomtat=$data['tomtat'];
        $chapter->slug_chapter=$data['slug_chapter'];
        $chapter->noidung=$data['noidung'];
        $chapter->truyen_id=$data['truyen_id'];/// vì bên kia lưu là $danh muc nên phải truyền là 'danhmuc'
        $chapter->kichhoat=$data['kichhoat'];
        
        $chapter->save();
        return redirect()->back()->with('status','Tạo Chapter thành công rồi nhớ');
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
        $chapter =Chapter::find($id);
        $truyen= Truyen::orderBy('id','DESC')->get();
        return view('admincp.chapter.edit')->with(compact('truyen','chapter'));
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
            'tieude'=> 'required|max:255',
            'tomtat' => 'required',
            'noidung' => 'required',
            'slug_chapter' => 'required|max:255',
            'kichhoat' => 'required',
            'truyen_id' => 'required',
            
        ],

        [
            'tieude.required'=> 'Tiêu đề chapter phải có chứ',
            'noidung.required'=> 'Nội dung phải có chứ',
            'tomtat.required' => 'Tóm tắt truyện đã có đâu, thêm vào đê',
            'slug_chapter.required' =>  'Slug truyện phải có nhé',
        ]);

        $chapter= Chapter::find($id);
        $chapter->tieude=$data['tieude'];
        $chapter->tomtat=$data['tomtat'];
        $chapter->slug_chapter=$data['slug_chapter'];
        $chapter->noidung=$data['noidung'];
        $chapter->truyen_id=$data['truyen_id'];/// vì bên kia lưu là $danh muc nên phải truyền là 'danhmuc'
        $chapter->kichhoat=$data['kichhoat'];
        
        $chapter->save();
        return redirect()->back()->with('status','Cập nhật Chapter thành công rồi nhớ');
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
        Chapter::find($id)->delete();
        return redirect()->back()->with('status','Xoá chapter thành công');
    }
}
