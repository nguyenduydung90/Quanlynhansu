<?php

namespace App\Http\Controllers;

use App\Models\Canbo;
use App\Models\Roles;
use App\Models\thongtinphanmem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    protected $user;
    protected $role;

    public function __construct(User $user, Roles $roles)
    {
        $this->user=$user;
        $this->role=$roles;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   if(auth()->user()->name == 'dev'){
        $model=$this->user->all();
        $role=$this->role->all();
    }else{
        $model=$this->user->where('name','!=','dev')->get();
        $role=$this->role->where('tenquyen','!=','dev')->get();
    }
        
        
        return view('system.taikhoan.index')
                    ->with('model',$model)
                    ->with('role',$role)
                    ->with('pageTitle','Tài khoản');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|unique:users',
            'name'=>'unique:users'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }    
            $inputs = $request->all();
            $password=1;
            
            $role_id=$request->role_id;    
            //Thêm mới tai khoan
            if ($inputs['id'] == 0) {
                $inputs['password']=Hash::make($password);
               $taikhoan= $this->user->create($inputs);
               $taikhoan->roles()->attach($role_id);
    
            }
    
            //Trả lại kết quả
            $result['message'] = 'Thao tác thành công.';
            $result['status'] = 'success';

			die(json_encode($result));
                
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    { 
        $inputs = $request->all();
        $id=$inputs['id'];
        $validator = Validator::make($request->all(), [
            'email' => 'email|unique:users,email,'.$id,
        ]);
       
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }  
        $role_id=$request->role_id; 
        $taikhoan=$this->user->findOrFail($id);
        if(empty($inputs['password'])){
            $inputs['password']=$taikhoan->password;
        }else{
            $inputs['password']=Hash::make($request->password);
        }

        if(empty($inputs['name'])){
            $inputs['name']=$taikhoan->name;
            $inputs['email']=$taikhoan->email;
        }
        $taikhoan->update($inputs);
        $taikhoan->roles()->sync($role_id);

        $result['message'] = 'Thao tác thành công.';
            $result['status'] = 'success';

			die(json_encode($result));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $taikhoan=$this->user->find($id);
        $taikhoan->delete();
        return redirect()->route('user.index');
    }

    public function login()
    {
        return view('system.login.login')->with('pageTitle','Đăng nhập');
    }

    public function logined(Request $request)
    {
        $credentials = $request->only('name', 'password');
        $message = '';
        if (Auth::attempt($credentials)) {    
            return redirect()->route('tongquan')->with('success','Đăng nhập thành công');
        }else{
            
            $message='Thông tin tài khoản hoặc mật khẩu không đúng';
            return redirect()->route('login')->with('message',$message);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function viewchangePassword(){
        return view('system.taikhoan.doimatkhau')->with('pageTitle','Đổi mật khẩu');
    }

    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with('errors',"Mật khẩu cũ không đúng");
        }

        $taikhoan=$this->user->findOrFail(Auth::user()->id);
        $data=[
            'name'=>Auth::user()->name,
            'email'=>Auth::user()->email,
            'password'=>Hash::make($request->newpassword)
        ];
        $taikhoan->update($data);
        return redirect()->back()->with('success',"Đổi mật khẩu thành công");;
    }

    public function tongquan(){
        $tong=Canbo::selectRaw('COUNT(id) AS soluong')->first();
        $cb_gioitinh=Canbo::selectRaw('COUNT(id) AS soluong, gioitinh')->groupBy('gioitinh')->get();
        $cb_chucvu=Canbo::selectRaw('COUNT(id) AS soluong, chucvu_id')->groupBy('chucvu_id')->get();
        $cb_pb=Canbo::selectRaw('COUNT(id) AS soluong, phongban_id')->groupBy('phongban_id')->get();
        
        return view('system.tongquan.tongquan')
                    ->with('cb_gioitinh',$cb_gioitinh)
                    ->with('cb_chucvu',$cb_chucvu)
                    ->with('cb_pb',$cb_pb)
                    ->with('tong',$tong)
                    ->with('pageTitle','Tổng quan');
    }
    
}
