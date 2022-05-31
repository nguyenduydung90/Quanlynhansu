<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChucvuRequest;
use App\Models\Chucvu;
use Illuminate\Http\Request;

class ChucvuController extends Controller
{

    protected $chucvu;
    public function __construct(Chucvu $chucvu)
    {
        $this->chucvu=$chucvu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model=$this->chucvu->orderBy('tencv')->get();
        return view('system.danhmuc.chucvu.index')
                                            ->with('model',$model)
                                            ->with('pageTitle','Danh mục chức vụ');
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
    public function store(ChucvuRequest $request)
    {
        $inputs = $request->all();    
        //Thêm mới chức vụ
        if ($inputs['id'] == 0) {
            $this->chucvu->create($inputs);
        } else {
            //update chức vụ
            $id=$inputs['id'];
            $chucvu=$this->chucvu->findOrFail($id);
            $chucvu->update($inputs);
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
        $chucvu=$this->chucvu->findOrFail($id);
        $chucvu->delete();
        return redirect()->route('chucvu.index');
    }
}
