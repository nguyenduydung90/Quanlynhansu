<?php

namespace App\Http\Controllers\Phanquyen;

use App\Http\Controllers\Controller;
use App\Models\Permissions;
use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    private $roles;
    private $permissions;

    public function __construct(Roles $roles, Permissions $permissions)
    {
        $this->roles = $roles;
        $this->permissions = $permissions;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = $this->roles->all();
        $permissionParents = $this->permissions->where('parent', 0)->get();
        return view('system.phanquyen.roles.index')
            ->with('model', $model)
            ->with('permissionParents', $permissionParents)
            ->with('pageTitle', 'Roles');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = $this->permissions->where('parent', 0)->get();
    return view('system.phanquyen.roles.create')
            ->with('model',$model)
            ->with('pageTitle','Roles');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = [
            'tenquyen' => $request->tenquyen,
            'diengiai' => $request->diengiai,

        ];
            $this->roles->create($input);

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
        $role=$this->roles->find($id);
        
        $permissionParents=$this->permissions->where('parent',0)->get();
        return view('system.phanquyen.roles.edit')
                                                ->with('role',$role)
                                                ->with('permissionParents',$permissionParents)
                                                ->with('pageTitle','Roles');
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
        $input=[
            'tenquyen'=>$request->tenquyen,
            'diengiai'=>$request->diengiai,
        ];
        $id_permission=$request->permission_id;
        $role=$this->roles->find($id);
        $role->update($input);
        $role->permissions()->sync($id_permission);
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role=$this->roles->find($id);
        $role->delete();
   
           return redirect()->route('roles.index');
    }
}
