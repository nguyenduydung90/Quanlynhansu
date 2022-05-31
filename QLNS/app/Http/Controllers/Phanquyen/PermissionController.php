<?php

namespace App\Http\Controllers\Phanquyen;

use App\Http\Controllers\Controller;
use App\Models\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    private $permission;
    public function __construct(Permissions $permissions)
    {
        $this->permission = $permissions;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $model = $this->permission->where('parent', 0)->get();
        return view('system.phanquyen.permissions.index')
            ->with('model', $model)
            ->with('pageTitle', 'Permissions');
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
        $dataModulDad = [
            'tenquyen' => $request->tenquyen,
            'diengiai' => $request->diengiai,
            'parent' => 0,
            'key_code' => ''
        ];
        //quản lý chi tiết các modul quyền(thêm, sửa, xóa)
        $permission_children=['list','edit','add','delete'];
        if ($request->id == 0) {
            try {
                DB::beginTransaction();
                $dataParent = $this->permission->create($dataModulDad);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return $e->getmessage();
            }

            

            foreach ($permission_children as $value) {

                $dataPermissionChildrent = [
                    'parent' => $dataParent->id,
                    'tenquyen' => $value,
                    'diengiai' => $value,
                    'key_code' => $value . '_' .chuanhoachuoi( $dataParent->tenquyen),
                ];
                try {
                    DB::beginTransaction();
                    $this->permission->create($dataPermissionChildrent);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    return $e->getmessage();
                }
            };
        } else {
            $id = $request->id;
            try {
                DB::beginTransaction();
                $dataParent = $this->permission->find($id);
                $dataParent->update($dataModulDad);
                foreach ($permission_children as $value) {

                    $dataPermissionChildrent = [
                        'parent' => $dataParent->id,
                        'tenquyen' => $value,
                        'diengiai' => $value,
                        'key_code' => $value . '_' .chuanhoachuoi( $dataParent->tenquyen),
                    ];
                    $check = $dataParent->permissionChildrent->toArray();
                    if (empty($check)) {
                        $this->permission->create($dataPermissionChildrent);
                    } else {

                        foreach ($dataParent->permissionChildrent as $item) {

                            $datachildrent = $this->permission->find($item->id);

                            if ($datachildrent != null) {
                                $datachildrent->delete();
                            }
                        }

                        $this->permission->create($dataPermissionChildrent);
                    }
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return $e->getmessage();
            };
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
        $parent=$this->permission->find($id);
        foreach($parent->permissionChildrent as $value){
            $datachildrent = $this->permission->find($value->id);
                            
            if($datachildrent != null){
                $datachildrent->delete();
            }
        }
        $parent->delete();
        return redirect()->route('permission.index');
    }
}
