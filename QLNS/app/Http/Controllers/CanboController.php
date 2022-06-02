<?php

namespace App\Http\Controllers;

use App\Http\Requests\CanboRequest;
use App\Models\Canbo;
use App\Models\Chucvu;
use App\Models\Phongban;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class CanboController extends Controller
{
    protected $canbo;
    protected $chucvu;
    protected $phongban;
    protected $user;

    public function __construct(Canbo $canbo, Chucvu $chucvu, Phongban $phongban, User $user)
    {
        $this->canbo = $canbo;
        $this->chucvu = $chucvu;
        $this->phongban = $phongban;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = $this->canbo->orderBy('hoten')->get();
        return view('system.danhmuc.canbo.index')->with('model', $model)
            ->with('pageTitle', 'Hồ sơ cán bộ');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $phongban = Phongban::all();
        $chucvu = Chucvu::all();

        return view('system.danhmuc.canbo.create')->with('phongban', $phongban)
            ->with('chucvu', $chucvu)
            ->with('pageTitle', 'Hồ sơ cán bộ');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CanboRequest $request)
    {
        $inputs = $request->all();
        $mkbandau = 1; //mật khẩu mặc định khi tạo tài khoản
        $arr = [];
        if ($request->file('file_cccd')) {
            $image = $request->file('file_cccd');

            foreach ($image as $key => $item) {
                $name = time() . $item->getClientOriginalName();
                $item->move('uploads/cccd/', $name);
                $arr[$key] = 'uploads/cccd/'.$name;
            }
        } else {
            $arr = 'images/no-thumbnail.png';
        }
        $inputs['file_cccd'] = is_array($arr) ? implode(",", $arr) : $arr;
        
        $arr_bc = [];
        if ($request->file('file_bc')) {
            $image_bc = $request->file('file_bc');

            foreach ($image_bc as $key => $item) {
                $name = time() . $item->getClientOriginalName();
                $item->move('uploads/bangcap/', $name);
                $arr_bc[$key] = 'uploads/bangcap/'.$name;
            }
        } else {
            $arr_bc = 'images/no-thumbnail.png';
        }
        $inputs['file_bc'] = is_array($arr_bc) ? implode(",", $arr_bc) : $arr_bc;



        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($mkbandau)
        ];
       // tạo tài khoản đăng nhập
        $this->user->create($data);
        $this->canbo->create($inputs);

        return redirect()->route('canbo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Canbo  $canbo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $model = Canbo::findOrFail($id);
        $model['chucvu'] = $model->chucvu->tencv;
        $model['phongban'] = $model->phongban->tenpb;
        $model['ngayvaoct'] = Carbon::parse($model->ngayvaoct)->format('d/m/Y');
        $model['ngaysinh'] = Carbon::parse($model->ngaysinh)->format('d/m/Y');

        die($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Canbo  $canbo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Canbo::findOrFail($id);
        $user=User::where('name',$model->hoten)->get();
        $taikhoan=$user[0]->name;
        $phongban = Phongban::all();
        $chucvu = Chucvu::all();

        return view('system.danhmuc.canbo.edit')->with('model', $model)
            ->with('phongban', $phongban)
            ->with('chucvu', $chucvu)
            ->with('taikhoan', $taikhoan)
            ->with('pageTitle', 'Chỉnh sửa hồ sơ cán bộ');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Canbo  $canbo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $inputs = $request->all();
        $canbo = $this->canbo->findOrFail($id);
        $taikhoan=User::where('name',$canbo->hoten)->get();
        $user_id=$taikhoan[0]->id;
        Validator::make($request->all(), [
            'email' => 'email|unique:canbo,email,'.$id,
            'name'=>'unique:users,name,'.$user_id,
            'hoten'=>'required',
            'sdt'=>'required',
            'ngaysinh'=>'required',
            'ngayvaoct'=>'required',
            'chucvu_id'=>'required',
        ])->validate();


        
        $defaulImg = 'images/no-thumbnail.png';
        //update ảnh cccd
            if ($request->file('file_cccd')) {
                if ($inputs['file_cccd'] != $defaulImg) {
                   $cccd= explode(',',$canbo->file_cccd);
                    foreach ($cccd as $item) {
                        if(File::exists($item)){
                            File::Delete($item);
                        }
                    }
                };
                $image = $request->file('file_cccd');
                $arr = [];
                foreach ($image as $key => $item) {
                    $name = time() . $item->getClientOriginalName();
                    $item->move('uploads/cccd/', $name);
                    $arr[$key] ='uploads/cccd/'.$name;
                }
            } else {
                $arr = $canbo->file_cccd;
            }
 
        
        $inputs['file_cccd'] = is_array($arr) ? implode(",", $arr) : $arr;


        //update ảnh bằng cấp
        if ($request->file('file_bc')) {
            if ($inputs['file_bc'] != $defaulImg) {
                $bangcap= explode(',',$canbo->file_bc);
                foreach ($bangcap as $item) {
                    if(File::exists($item)){
                        File::Delete($item);
                    }
                }
            };
            $image_bc = $request->file('file_bc');
            $arr_bc = [];
            foreach ($image_bc as $key => $item) {
                $name = time() . $item->getClientOriginalName();
                $item->move('uploads/bangcap/', $name);
                $img = 'uploads/bangcap/' . $name;
                $arr_bc[$key] = $img;
            }
        } else {
            $arr_bc = $canbo->file_bc;
        }
        $inputs['file_bc'] = is_array($arr_bc) ? implode(",", $arr_bc) : $arr_bc;


        //update tài khoản
        if($inputs['name']!= $taikhoan[0]->name){
           
            $data=[
                'name'=> $inputs['name'],
                'password'=>$taikhoan[0]->password,
                'email'=>$inputs['email']
            ];
            $taikhoan[0]->update($data);
        }

        $canbo->update($inputs);

        $id_pb = $request->phongban_id;
        if ($request->id_pb == 'dscb_pb') {
            return redirect('/danh_muc/dm_phongban/chitiet/' . $id_pb);
        } else {
            return redirect()->route('canbo.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Canbo  $canbo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $defaulImg = 'images/no-thumbnail.png';
        $canbo = $this->canbo->findOrFail($id);
        $cccd=explode(',',$canbo->file_cccd);
        $bangcap=explode(',',$canbo->file_bc);
        foreach($cccd as $item){
            if($item !=$defaulImg){
                if(File::exists(',',$item)){
                    File::Delete($item);
                }
            }
        }

        foreach($bangcap as $value){
            if($value !=$defaulImg){
                if(File::exists(',',$value)){
                    File::Delete($value);
                }
            }
        }
        $canbo->delete();
        return redirect()->route('canbo.index');
    }

    public function search()
    {
        $chucvu = $this->chucvu->all();
        $phongban = $this->phongban->all();

        return view('system.search.canbo.search')
            ->with('chucvu', $chucvu)
            ->with('phongban', $phongban)
            ->with('pageTitle', 'Tra cứu hồ sơ cán bộ');
    }

    public function result(Request $request)
    {
        $inputs = $request->all();
        $model = Canbo::orderBy('hoten', 'asc');

        if ($inputs['hoten'] != '') {
            $model = $model->where('hoten', 'LIKE', '%' . $inputs['hoten'] . '%');
        }
        if ($inputs['diachi'] != '') {
            $model = $model->where('diachi', 'LIKE', '%' . $inputs['diachi'] . '%');
        }
        if ($inputs['email'] != '') {
            $model = $model->where('email', 'LIKE', '%' . $inputs['email'] . '%');
        }
        if ($inputs['dienthoai'] != '') {
            $model = $model->where('dienthoai', 'LIKE', '%' . $inputs['dienthoai'] . '%');
        }
        if ($inputs['gioitinh'] != '') {
            $model = $model->where('gioitinh', $inputs['gioitinh']);
        }
        if ($inputs['chucvu_id'] != '') {
            $model = $model->where('chucvu_id', $inputs['chucvu_id']);
        }
        if ($inputs['phongban_id'] != '') {
            $model = $model->where('phongban_id', $inputs['phongban_id']);
        }
        if ($inputs['ngaysinh'] != '') {
            $model = $model->where('ngaysinh', $inputs['ngaysinh']);
        }

        $model = $model->get();

        return view('system.search.canbo.result')
            ->with('model', $model)
            ->with('pageTitle', 'Tra cứu hồ sơ cán bộ');
    }
}
