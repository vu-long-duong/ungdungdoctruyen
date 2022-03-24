<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;

class TruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $list_truyen =Truyen::with('danhmuctruyen')->orderBy('id','DESC')->get();
        //test xem đã liên kết 2 bảng danh mục truyện và truyện được chưa
        //     dd($truyen);
         return view('admincp.truyen.index')->with(compact('list_truyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $danhmuc= DanhmucTruyen::orderBy('id','DESC')->get();
        return view('admincp.truyen.create')->with(compact('danhmuc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'tentruyen'=> 'required|unique:truyen|max:255',
            'tomtat' => 'required',
            'tacgia' => 'required|max:255',
            'slug_truyen' => 'required|max:255',
            'kichhoat' => 'required',
            'danhmuc' => 'required',
            ///tương tự trường danhmuc_id nhớ
            'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000',
        ],

        [
            'tentruyen.unique'=> 'Tên truyện đã tồn tại',
            'tentruyen.required'=> 'Tên truyện phải có chứ',
            'tacgia.required'=> 'Tên tác giả phải có chứ',
            'tomtat.required' => 'Tóm tắt truyện đã có đâu, thêm vào đê',
            'hinhanh.required' => 'Hình ảnh truyện đã có đâu, thêm vào đê',
            'slug_truyen.required' =>  'Slug truyện phải có nhé',
            'danhmuc.required'=> 'Tên danh mục chưa có à',
        ]);

        $truyen= new Truyen();
        $truyen->tentruyen=$data['tentruyen'];
        $truyen->tomtat=$data['tomtat'];
        $truyen->slug_truyen=$data['slug_truyen'];
        $truyen->tacgia=$data['tacgia'];
        $truyen->danhmuc_id=$data['danhmuc'];/// vì bên kia lưu là $danh muc nên phải truyền là 'danhmuc'
        $truyen->kichhoat=$data['kichhoat'];
        ////them anh vao folder
        $get_image = $request->hinhanh;
        $path = 'uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image= current(explode('.',$get_name_image));
        $new_image =$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $truyen->hinhanh=$new_image;
        $truyen->save();
        return redirect()->back()->with('status','Thêm truyện thành công rồi nhớ');
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
        $truyen =Truyen::find($id);
        $danhmuc= DanhmucTruyen::orderBy('id','DESC')->get();
        return view('admincp.truyen.edit')->with(compact('truyen','danhmuc'));
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
            'tentruyen'=> 'required|max:255',
            'tomtat' => 'required',
            'tacgia' => 'required|max:255',
            'slug_truyen' => 'required|max:255',
            'kichhoat' => 'required',
            'danhmuc' => 'required',
            ///tương tự trường danhmuc_id nhớ
            //không yêu cầu hình ảnh nhé
        ],

        [
            'tentruyen.required'=> 'Tên truyện phải có chứ',
            'tacgia.required'=> 'Tên tác giả phải có chứ',
            'tomtat.required' => 'Tóm tắt truyện đã có đâu, thêm vào đê',
            'hinhanh.required' => 'Hình ảnh truyện đã có đâu, thêm vào đê',
            'slug_truyen.required' =>  'Slug truyện phải có nhé',
            'danhmuc.required'=> 'Tên danh mục chưa có à',
        ]);

        $truyen= Truyen::find($id);
        $truyen->tentruyen=$data['tentruyen'];
        $truyen->tomtat=$data['tomtat'];
        $truyen->slug_truyen=$data['slug_truyen'];
        $truyen->tacgia=$data['tacgia'];
        $truyen->danhmuc_id=$data['danhmuc'];/// vì bên kia lưu là $danh muc nên phải truyền là 'danhmuc'
        $truyen->kichhoat=$data['kichhoat'];
        ////them anh vao folder
        $get_image = $request->hinhanh;
        if($get_image){
        // nếu người dùng ko muốn chọn hình ảnh khác(giữ nguyên hình ảnh)
        $path='public/uploads/truyen/'.$truyen->hinhanh;
        if(file_exists($path)){
            unlink($path);
        }
        $path = 'uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image= current(explode('.',$get_name_image));
        $new_image =$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $truyen->hinhanh=$new_image;
        }
        $truyen->save();
        return redirect()->back()->with('status','Cập nhật truyện thành công rồi nhớ');
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
        $truyen =Truyen::find($id);
        $path='uploads/truyen/'.$truyen->hinhanh;
        if(file_exists($path)){
            unlink($path);
        }
        Truyen::find($id)->delete();
        return redirect()->back()->with('status','Xóa truyện thành công');
    }
}
