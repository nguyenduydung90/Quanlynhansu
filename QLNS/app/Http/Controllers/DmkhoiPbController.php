<?php

namespace App\Http\Controllers;

use App\Http\Requests\DmkhoiPbRequest;
use Illuminate\Http\Request;
use App\Models\DmkhoiPb;
use App\Models\Phongban;


class DmkhoiPbController extends Controller
{

    protected $dmkhoipb;
    protected $phongban;
    public function __construct(DmkhoiPb $dmkhoipb, Phongban $phongban)
    {
        $this->dmkhoipb = $dmkhoipb;
        $this->phongban = $phongban;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = $this->dmkhoipb->orderBy('tenkhoi')->get();
        return view('system.danhmuc.dmkhoipb.index')
            ->with('model', $model)
            ->with('pageTitle', 'Danh mục khối phòng ban');
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
    public function store(DmkhoiPbRequest $request)
    {
        $inputs = $request->all();
        //Thêm mới danh mục khối phòng ban
        if ($inputs['id'] == 0) {
            $this->dmkhoipb->create($inputs);
        } else {
            //update danh mục khối phòng ban
            $id = $inputs['id'];
            $dmkhoipb = $this->dmkhoipb->findOrFail($id);
            $dmkhoipb->update($inputs);
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
        $model = DmkhoiPb::join('phongban', 'phongban.dmkhoi_id', '=', 'dmkhoipb.id')
            ->select('phongban.*', 'dmkhoipb.tenkhoi')
            ->where('dmkhoipb.id', $id)
            ->get();

        $chucvu = DmkhoiPb::join('phongban', 'phongban.dmkhoi_id', '=', 'dmkhoipb.id')
            ->join('canbo', 'canbo.phongban_id', '=', 'phongban.id')
            ->join('chucvu', 'chucvu.id', '=', 'canbo.chucvu_id')
            ->select('canbo.hoten')
            ->where('dmkhoipb.id', $id)
            ->where('chucvu.tencv', 'Phó giám đốc')
            ->get();

        $phongban=Phongban::where('phongban.dmkhoi_id','!=',$id)->get();
        $khoipb = DmkhoiPb::findOrFail($id);
        return view('system.danhmuc.dmkhoipb.detail')
            ->with('model', $model)
            ->with('khoipb', $khoipb)
            ->with('chucvu', $chucvu)
            ->with('phongban', $phongban)
            ->with('pageTitle', 'Danh mục khối phòng ban');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dmkhoipb = $this->dmkhoipb->findOrFail($id);
        $dmkhoipb->delete();
        return redirect()->route('dmkhoipb.index');
    }
}
