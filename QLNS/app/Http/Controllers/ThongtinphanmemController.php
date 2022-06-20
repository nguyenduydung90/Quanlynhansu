<?php

namespace App\Http\Controllers;

use App\Models\Canbo;
use App\Models\lichsu;
use Illuminate\Http\Request;
use App\Models\thongtinphanmem;
use App\Models\Files;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ThongtinphanmemController extends Controller
{
    protected $ttpm;

    public function __construct(thongtinphanmem $ttpm)
    {
        $this->ttpm=$ttpm;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $model=$this->ttpm->orderBy('tenpm','asc')->get();
        $canbo=Canbo::all();
        return view('manager.ttpm.index')
                ->with('model',$model)
                ->with('canbo',$canbo)
                ->with('pageTitle','Thông tin phần mềm');
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
        $inputs= $request->all();
        if ($request->file('hdsd')) {
                $file = $request->file('hdsd');
                $name = time() . $file->getClientOriginalName();
                $file->move('uploads/document', $name);
                $hdsd = 'uploads/document/' . $name;
                $inputs['hdsd']=$hdsd;
        }


        $pm=$this->ttpm->create($inputs);

        $data=[
            'ttpm_id'=>$pm->id,
            'tenpm'=>$pm->tenpm,
            'cbphutrach'=>$pm->canbo_id==null?'Chưa phân':$pm->canbo->hoten,
            'thoigiantao'=>$pm->created_at,
            'thoigiancapnhat'=>$pm->updated_at,
            'tkthuchien'=>auth()->user()->name
        ];
        lichsu::create($data);

        return redirect()->route('ttpm.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model=lichsu::where('ttpm_id',$id)->get();
        $ttpm=$this->ttpm->findOrFail($id);
        $tenpm=$ttpm->tenpm;
        return view('manager.ttpm.lichsu')
                ->with('model',$model)
                ->with('tenpm',Str::upper($tenpm))
                ->with('pageTitle','Lịch sử theo dõi');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
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
        $inputs=$request->all();
        $pm=$this->ttpm->findOrFail($id);
        if ($request->file('hdsd')) {
            if(File::exists($pm->hdsd)){
                File::Delete($pm->hdsd);
            }
            $file = $request->file('hdsd');
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/document', $name);
            $hdsd = 'uploads/document/' . $name;
            $inputs['hdsd']=$hdsd;
    }else{
        $hdsd=$pm->hdsd;
        $inputs['hdsd']=$hdsd;
    }



        $pm->update($inputs);

    $data=[
        'ttpm_id'=>$pm->id,
        'tenpm'=>$pm->tenpm,
        'cbphutrach'=>$pm->canbo_id==null?'Chưa phân':$pm->canbo->hoten,
        'thoigiantao'=>$pm->created_at,
        'thoigiancapnhat'=>$pm->updated_at,
        'tkthuchien'=>auth()->user()->name
    ];
    lichsu::create($data);

return redirect()->route('ttpm.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pm=$this->ttpm->findOrFail($id);
        if(File::exists($pm->hdsd)){
            File::Delete($pm->hdsd);
        }
        if(File::exists($pm->linkdm)){
            File::Delete($pm->link);
        }

        $file=Files::where('ttpm_id',$pm->id)->first();
        if (File::exists($file->demo)) {
            File::Delete($file->demo);
        };
        if (File::exists($file->hdsd)) {
            File::Delete($file->hdsd);
        };

        $file->delete();
        $pm->delete();
        return redirect()->route('ttpm.index');
    }
}
