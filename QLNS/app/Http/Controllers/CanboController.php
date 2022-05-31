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


class CanboController extends Controller
{
    protected $canbo;
    protected $chucvu;
    protected $phongban;
    protected $user;

    public function __construct(Canbo $canbo, Chucvu $chucvu, Phongban $phongban,User $user)
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
            ->with('type', 'create')
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
        $mkbandau=1;//mật khẩu mặc định khi tạo tài khoản
        if ($request->file('anh')) {
            $image = $request->file('anh');
            $name = time() . $image->getClientOriginalName();
            $image->move('uploads/avarta', $name);
            $img = 'uploads/avarta/' . $name;
        } else {
            $img = 'images/avatar/no-image.png';
        }
        $inputs['anh'] = $img;
        $inputs['kpcd']=chkDbl($request->kpcd);
        // unset($request->hoten);
        $this->canbo->create($inputs);

        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($mkbandau)
        ];
        //tạo tài khoản đăng nhập
        $this->user->create($data);

        return redirect()->route('canbo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Canbo  $canbo
     * @return \Illuminate\Http\Response
     */
    public function show(Canbo $canbo)
    {
        //
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
        $phongban = Phongban::all();
        $chucvu = Chucvu::all();

        return view('system.danhmuc.canbo.edit')->with('model', $model)
            ->with('phongban', $phongban)
            ->with('chucvu', $chucvu)
            ->with('type', 'edit')
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
        Validator::make($request->all(), [
            'email' => 'email|unique:canbo,email,'.$id,
            'hoten'=>'required',
            'gioitinh'=>'required',
            'dienthoai'=>'required',
            'ngaysinh'=>'required',
            'ngayvao'=>'required',
            'chucvu_id'=>'required',
            'anh'=>'image',
        ])->validate();
        $canbo = $this->canbo->findOrFail($id);
        $img = $request->file('anh');
        $defaulImg = 'images/avatar/no-image.png';
        if ($request->file('anh')) {
            if ($request->file('anh') != $defaulImg) {
                File::Delete($canbo->anh);
            };
            $image = $request->file('anh');
            $name = time() . $image->getClientOriginalName();
            $image->move('uploads/avarta', $name);
        }
        $inputs['anh'] = $img ? 'uploads/avarta/' . $name : $canbo->anh;
        $inputs['kpcd']=chkDbl($request->kpcd);
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
        $canbo = $this->canbo->findOrFail($id);
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
