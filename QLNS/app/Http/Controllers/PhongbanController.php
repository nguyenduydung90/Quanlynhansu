<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhongbanRequest;
use App\Models\Canbo;
use App\Models\DmkhoiPb;
use App\Models\Phongban;
use Illuminate\Http\Request;

class PhongbanController extends Controller
{

    protected $phongban;
    protected $dmkhoiPb;
    public function __construct(Phongban $phongban,DmkhoiPb $dmkhoiPb)
    {
        $this->phongban=$phongban;
        $this->dmkhoiPb=$dmkhoiPb;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model=Phongban::orderBy('tenpb')->get();
        $arr=$model->toArray();
        $id_kpb=[];
        foreach($arr as $v){
            array_push($id_kpb,$v['id']);
        }
        $khoipbs=DmkhoiPb::all();
        return view('system.danhmuc.phongban.index')->with('model',$model)
                                                    ->with('khoipbs',$khoipbs)
                                                    ->with('id_kpb',$id_kpb)
                                                    ->with('pageTitle','Danh mục phòng ban');
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
    public function store(PhongbanRequest $request)
    {
        $inputs = $request->all(); 
          
        //Thêm mới phongban
        if ($inputs['id'] == 0) {
            $this->phongban->create($inputs);
        } else {
            //update phongban
            $id=$inputs['id'];
            $phongban=$this->phongban->findOrFail($id);
            $phongban->update($inputs);
        }

        //Trả lại kết quả
        $result['message'] = 'Thao tác thành công.';
        $result['status'] = 'success';

        die(json_encode($result));
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phongban  $phongban
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        //lay danh sach can bo thuoc phong ban
        $model=Phongban::join('canbo','canbo.phongban_id','=','phongban.id')
                        ->join('chucvu','chucvu.id','=','canbo.chucvu_id')
                            ->select('canbo.*','phongban.tenpb','chucvu.tencv')
                            ->where('phongban.id',$id)
                            ->get();
        //lay danh sach can bo khac phong ban
        $canbo=Canbo::where('canbo.phongban_id','!=',$id)->get();
        $phongban=$this->phongban->findOrFail($id);
        $tenpb=mb_strtoupper($phongban->tenpb,'UTF-8');       
        return view('system.danhmuc.phongban.detail')->with('model',$model)
                                                        ->with('tenpb',$tenpb)
                                                        ->with('canbo',$canbo)
                                                        ->with('phongban',$phongban)
                                                        ->with('pageTitle','Phòng ban');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phongban  $phongban
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
     * @param  \App\Models\Phongban  $phongban
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phongban  $phongban
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $phongban=$this->phongban->findOrFail($id);
        $phongban->delete();
        return redirect()->route('phongban.index');
    }
}
