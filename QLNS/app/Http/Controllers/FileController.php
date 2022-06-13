<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use Illuminate\Http\Request;
use App\Models\Files;
use App\Models\lichsufile;
use App\Models\thongtinphanmem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FileController extends Controller
{
    protected $file;
    public function __construct(Files $file)
    {
        $this->file = $file;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = $this->file->all();
        $arr=[];
        foreach($model as $value){
            array_push($arr,$value->ttpm_id);
        }
        $pm = thongtinphanmem::whereNotIn('id',$arr)->get();
        $pmedit=thongtinphanmem::all();
        return view('manager.file.index')
            ->with('model', $model)
            ->with('pm', $pm)
            ->with('pmedit', $pmedit)
            ->with('pageTitle', 'File phần mềm');
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
        $inputs = $request->all();
        if ($request->file('hdsd')) {
            $file = $request->file('hdsd');
            $name_file_gt = time() . $file->getClientOriginalName();
            $file->move('uploads/document', $name_file_gt);
            $hdsd = 'uploads/document/' . $name_file_gt;
            $inputs['hdsd'] = $hdsd;
        }

        if ($request->file('demo')) {
            $file = $request->file('demo');
            $name_file_demo = time() . $file->getClientOriginalName();
            $file->move('uploads/demo', $name_file_demo);
            $demo = 'uploads/demo/' . $name_file_demo;
            $inputs['demo'] = $demo;
        }


        $pm = $this->file->create($inputs);
        $cb = Files::join('thongtinphanmems', 'thongtinphanmems.id', '=', 'files.ttpm_id')
            ->join('canbo', 'canbo.id', '=', 'thongtinphanmems.canbo_id')
            ->select('canbo.hoten')
            ->distinct()
            ->where('files.ttpm_id', $pm->ttpm_id)
            ->first();
        $data = [
            'ttpm_id' => $pm->ttpm_id,
            'tenpm' => $pm->ttpm->tenpm,
            'file_gt' => $request->file('hdsd')? $request->file('hdsd')->getClientOriginalName():'',
            'file_demo' => $request->file('demo')? $request->file('demo')->getClientOriginalName():'',
            'thoigiantao' => $pm->created_at,
            'thoigianchinhsua' => $pm->updated_at,
            'tkthuchien' => auth()->user()->name,
            'cbphutrach' => $cb->hoten,
        ];
        lichsufile::create($data);
        return redirect()->route('file.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model=lichsufile::where('ttpm_id',$id)->get();
        $pm=thongtinphanmem::findOrFail($id);
        $tenpm=Str::upper($pm->tenpm);
        return view('manager.file.lichsu')
                    ->with('model',$model)
                    ->with('tenpm',$tenpm)
                    ->with('pageTitle','Lịch sử theo dõi File phần mềm');
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
        $inputs = $request->all();
        $file = $this->file->findOrFail($id);
        if ($request->file('hdsd')) {
            if (File::exists($file->hdsd)) {
                File::Delete($file->hdsd);
            };
            $files = $request->file('hdsd');
            $name = time() . $files->getClientOriginalName();
            $files->move('uploads/document', $name);
            $hdsd = 'uploads/document/' . $name;
            $inputs['hdsd'] = $hdsd;
        } else {
            $inputs['hdsd'] = $file->hdsd;
        }

        if ($request->file('demo')) {
            if (File::exists($file->demo)) {
                File::Delete($file->demo);
            };
            $files = $request->file('demo');
            $name = time() . $files->getClientOriginalName();
            $files->move('uploads/demo', $name);
            $demo = 'uploads/demo/' . $name;
            $inputs['demo'] = $demo;
        } else {
            $inputs['demo'] = $file->demo;
        }

        $file->update($inputs);
        $pm = $this->file->findOrFail($id);
        $cb = Files::join('thongtinphanmems', 'thongtinphanmems.id', '=', 'files.ttpm_id')
            ->join('canbo', 'canbo.id', '=', 'thongtinphanmems.canbo_id')
            ->select('canbo.hoten')
            ->distinct()
            ->where('files.ttpm_id', $pm->ttpm_id)
            ->first();
        $data = [
            'ttpm_id' => $pm->ttpm_id,
            'tenpm' => $pm->ttpm->tenpm,
            'file_gt' =>$request->file('hdsd')? $request->file('hdsd')->getClientOriginalName():'Không có thay đổi',
            'file_demo' => $request->file('demo')? $request->file('demo')->getClientOriginalName():'Không có thay đổi',
            'thoigiantao' => $pm->created_at,
            'thoigianchinhsua' => $pm->updated_at,
            'tkthuchien' => auth()->user()->name,
            'cbphutrach' => $cb->hoten,
        ];
        lichsufile::create($data);

        return redirect()->route('file.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = $this->file->findOrFail($id);
        if (File::exists($file->demo)) {
            File::Delete($file->demo);
        };
        if (File::exists($file->hdsd)) {
            File::Delete($file->hdsd);
        };

        $file->delete();

        return redirect()->route('file.index');
    }
}
