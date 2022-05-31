<?php

namespace App\Http\Controllers;

use App\Models\bangluong;
use App\Models\bangluong_ct;
use App\Models\Canbo;
use App\Models\Phongban;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BangluongController extends Controller
{
    protected $bangluong;
    protected $bangluong_ct;

    public function __construct(bangluong $bangluong, bangluong_ct $bangluong_ct)
    {
        $this->bangluong=$bangluong;
        $this->bangluong_ct=$bangluong_ct;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model= bangluong::orderBy('nam','desc')
                            ->orderBy('thang','desc')
                            ->get();
        $nam=[2021,2022,2023];
        return view('manager.bangluong.index')
                ->with('pageTitle','Bảng lương')
                ->with('model',$model)
                ->with('nam',$nam);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nam=[2021,2022,2023];
        return view('manager.bangluong.create')->with('pageTitle','Bảng lương')->with('nam',$nam);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs=$request->all();
        $inputs['ngaylap']=Carbon::now()->toDateTimeString();
        $inputs['nguoilap']=Auth()->user()->name;
        $bl=$this->bangluong->create($inputs);

        $cb=Canbo::all();
        $datas=[];
        foreach($cb as $key => $value){
           //add lương của từng cán bộ vào bảng bangluong_ct 
            $datas['mabl']=$bl->id;
            $datas['macb']=$value->id;
            $datas['luongchucvu']=cheknull($value->chucvu->mucluong);
            $datas['luongthamnien']=cheknull($value->luongthamnien);
            $datas['luongtrachnhiem']=cheknull($value->luongtrachnhiem);
            $datas['pccbptts']=cheknull($value->pccbptts);
            $datas['lbcb']=cheknull($value->lbcb);
            $datas['lsp']=cheknull($value->lsp);
            $datas['congtacphi']=$value->congtacphi;
            $datas['pcat']=cheknull($value->pcat);
            $datas['pcxx']=cheknull($value->pcxx);
            $datas['pcdt']=cheknull($value->pcdt);
            $datas['kpcd']=chkDbl($value->kpcd);
            $datas['luongcoban']=0;
            if($value->bangcap == 'Cao học' || $value->bangcap == 'Đại học'){
                $datas['luongcoban']=4205000;
            }elseif($value->bangcap == 'Cao đẳng'){
                $datas['luongcoban']=3980000;
            }elseif($value->bangcap == 'Trung cấp'|| $value->bangcap == 'Học nghề'){
                $datas['luongcoban']=3605000;
            }elseif($value->bangcap=='Không bằng cấp'){
                $datas['luongcoban']=3400000;
            }
            $datas['ptbhxh']=($value->ptbhxh * $datas['luongcoban'])/100;
            $datas['ptbhyt']=($value->ptbhyt * $datas['luongcoban'])/100;
            $datas['ptbhtn']=($value->ptbhtn * $datas['luongcoban'])/100;

            $datas['tongluong']= $datas['luongcoban']+$datas['luongchucvu']+$datas['luongtrachnhiem']+$datas['luongthamnien']+ $datas['pccbptts']+$datas['lbcb']+$datas['lsp']+$datas['pcat']+$datas['pcxx'];
            $tbh=$datas['ptbhxh'] + $datas['ptbhyt'] + $datas['ptbhtn']; 
            $datas['thucnhan']=$datas['tongluong']- $datas['kpcd'] - $tbh;
            $this->bangluong_ct->create($datas);
           
        }
        // $result['message'] = '/chucnang/luong/bangluong/'.$mabl;
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
        $model=bangluong::join('bangluong_ct','bangluong_ct.mabl','=','bangluong.id')
                            ->join('canbo','canbo.id','=','bangluong_ct.macb')
                            ->join('phongban','phongban.id','=','canbo.phongban_id')
                            ->join('chucvu','chucvu.id','=','canbo.chucvu_id')
                            ->select('bangluong_ct.*','bangluong_ct.id AS blct_id','bangluong.*','canbo.hoten','phongban.tenpb','chucvu.tencv')
                            ->where('bangluong.id',$id)
                            ->get();
        $m_bl=$this->bangluong->findOrFail($id);
        return view('manager.bangluong.bangluong')
                ->with('pageTitle','Chi tiết bảng lương')
                ->with('model',$model)
                ->with('m_bl',$m_bl);
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $inputs=$request->all();
        $bangluong=$this->bangluong->findOrFail($inputs['id']);
        die($bangluong);
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
        $inputs=$request->all();
        $bangluong=$this->bangluong->findOrFail($inputs['id']);
        $bangluong->update($inputs);

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
        $bangluong=$this->bangluong->findOrFail($id);        
        $bangluong->delete();
        $bangluong_ct=$this->bangluong_ct->where('bangluong_ct.mabl',$id)->get();
        foreach($bangluong_ct as $value){
            $value->delete();
        }
       
        return redirect()->route('bangluong.index');
    }

    public function detail($mabl, $id){
        $model=bangluong_ct::join('canbo','canbo.id','=','bangluong_ct.macb')
                ->select('bangluong_ct.*','canbo.hoten')
                ->where('bangluong_ct.id',$id)
                ->get();
        $model=$model[0];
        $model->hoten=Str::upper($model->hoten);       
       return view('manager.bangluong.detail')
                ->with('pageTitle', 'Bảng lương chi tiết cán bộ')
                ->with('model',$model);
    }

    public function updatect(Request $request){
        $mabl=$request->id;
        $cb=Canbo::all();
        $datas=[];
        foreach($cb as $value){
           //add lương của từng cán bộ vào bảng bangluong_ct 
            $datas['mabl']=$mabl;
            $datas['macb']=$value->id;
            $datas['luongchucvu']=cheknull($value->chucvu->mucluong);
            $datas['luongthamnien']=cheknull($value->luongthamnien);
            $datas['luongtrachnhiem']=cheknull($value->luongtrachnhiem);
            $datas['pccbptts']=cheknull($value->pccbptts);
            $datas['lbcb']=cheknull($value->lbcb);
            $datas['lsp']=cheknull($value->lsp);
            $datas['contacphi']=$value->congtacphi;
            $datas['pcat']=cheknull($value->pcat);
            $datas['pcxx']=cheknull($value->pcxx);
            $datas['pcdt']=cheknull($value->pcdt);
            $datas['kpcd']=cheknull($value->kpcd);
            $datas['tiencom']=cheknull($value->tiencom);
            $datas['tienphat']=cheknull($value->tienphat);
            $datas['luongcoban']=0;
            if($value->bangcap == 'Cao học' || $value->bangcap == 'Đại học'){
                $datas['luongcoban']=4205000;
            }elseif($value->bangcap == 'Cao đẳng'){
                $datas['luongcoban']=3980000;
            }elseif($value->bangcap == 'Trung cấp'|| $value->bangcap == 'Học nghề'){
                $datas['luongcoban']=3605000;
            }elseif($value->bangcap=='Không bằng cấp'){
                $datas['luongcoban']=3400000;
            }
            $datas['ptbhxh']=($value->ptbhxh * $datas['luongcoban'])/100;
            $datas['ptbhyt']=($value->ptbhyt * $datas['luongcoban'])/100;
            $datas['ptbhtn']=($value->ptbhtn * $datas['luongcoban'])/100;

            $datas['tongluong']= $datas['luongcoban']+$datas['luongchucvu']+$datas['luongtrachnhiem']+$datas['luongthamnien']+ $datas['pccbptts']+$datas['lbcb']+$datas['lsp']+$datas['pcat']+$datas['pcxx'];
            $tbh=$datas['ptbhxh'] + $datas['ptbhyt'] + $datas['ptbhtn']; 
            $datas['thucnhan']=$datas['tongluong']- $datas['kpcd'] - $tbh-$datas['tiencom']-$datas['tienphat'];
            $bangluong_ct=$this->bangluong_ct
                                            ->where('bangluong_ct.macb',$value->id)
                                            ->where('bangluong_ct.mabl',$mabl)
                                            ->get();
            foreach($bangluong_ct as $item){
                $item->update($datas);
            }

           
        }
        // $result['message'] = '/chucnang/luong/bangluong/'.$mabl;
        $result['status'] = 'success';
        die(json_encode($result));
    }

    public function inbangluong($mabl){
        $phongban=Phongban::all();
        $thongtin=bangluong::select('thang','nam','nguoilap')->where('id',$mabl)->first();
        $data=[];
        foreach($phongban as $value){
            $model= bangluong_ct::join('bangluong','bangluong.id','=','bangluong_ct.mabl')
            ->join('canbo','canbo.id','=','bangluong_ct.macb')
            ->join('phongban','phongban.id','=','canbo.phongban_id')
            ->select('bangluong_ct.*','bangluong.*','canbo.hoten','phongban.tenpb')
            ->where('bangluong_ct.mabl',$mabl)
            ->where('phongban.id',$value->id)
            ->get();
            $data[$value->id]=$model;
        }

        $bangluong_ct=bangluong_ct::where('bangluong_ct.mabl',$mabl)->get();       
        return view('reports.bangluong.maubangluong')
                    ->with('pageTitle','In bảng lương')
                    ->with('data',$data)
                    ->with('phongban',$phongban)
                    ->with('thongtin',$thongtin)
                    ->with('bangluong_ct',$bangluong_ct);
    }
}
