<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Repositories\PermissionRepository as Permission;
use App\Repositories\PermissionGroupRepository as PermissionGroup;
use App\Http\Requests\Permission\PermissionRequest;
use App\Http\Requests\Permission\SortPermissionRequest;
use Datatables;

class PermissionController extends Controller {

    private $permission;

    public function __construct(Permission $permission,PermissionGroup $permissiongroup)
    {
        $this->permission = $permission;
        $this->permissiongroup = $permissiongroup;
    }

    public function index(Request $request)
    {
/*        $html = Datatables::of($this->permission->all())
            ->addColumn('permissiondependencies',  function($model) {
                $str = '';
                foreach ($model->dependencies as $dependency) {
                    $str.= '<span class="label label-info">'.$dependency->permission->display_name.'</span> ';
                }
                return $str;
            })
            ->addColumn('action', function($model) { return $this->permission->actionButttons($model);})
            ->editColumn('group_id', function($model) { if($model->group){return $model->group->name;}})
            ->make(true);
        return view('test',compact('html'));*/
        if ($request->ajax()) {
            return Datatables::of($this->permission->all())
            ->addColumn('permissiondependencies',  function($model) {
                $str = '';
                foreach ($model->dependencies as $dependency) {
                    $str.= '<span class="label label-info">'.$dependency->permission->display_name.'</span> ';
                }
                return $str;
            })
            ->addColumn('action', function($model) { return $this->permission->actionButttons($model);})
            ->editColumn('group_id', function($model) { if($model->group){return $model->group->name;}})
            ->make(true);
        }
        $html = $this->permission->columns();
        return view('layout.partials.datatable',compact('html'));
    }

    public function create(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\PermissionForm', [
            'method' => 'POST',
            'url' => route('admin.permissions.store')
        ]);
        $script = 'js/backend/access/permissions/dependencies/script.js';
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form','script'));
    }

    public function store(PermissionRequest $request)
    {
        $permission = $this->permission->save(null, $request->all());
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }
        $route = ($request->get('task')=='apply') ? route('admin.permissions.edit', $permission->id) : route('admin.permissions.index');
        return redirect($route)->with([
            'status' => trans('messages.saved'),
            'type' => 'success'
        ]);
    }

    public function show($id)
    {
        $permission = $this->permission->find($id);

        return view('rbac.permission', compact('permission'));
    }

    public function edit($id, Request $request, FormBuilder $formBuilder)
    {
        $permission = $this->permission->find($id);

        $form = $formBuilder->create('App\Forms\PermissionForm', [
            'model' => $permission,
            'method' => 'PUT',
            'url' => route('admin.permissions.update', $id)
        ]);
        $script = 'js/backend/access/permissions/dependencies/script.js';
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form','script'));
    }

    public function update($id, PermissionRequest $request)
    {
        $this->permission->saveWithDependencies($id, $request->all());
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }        $route = ($request->get('task')=='apply') ? route('admin.permissions.edit', $id) : route('admin.permissions.index');
        return redirect($route)->with([
            'status' => trans('messages.saved'),
            'type' => 'success'
        ]);
    }

    public function updateSort(SortPermissionRequest $request) {
        $this->permission->updateSort($request->get('data'));
        return response()->json(['status' => 'OK']);
    }

    public function destroy($ids)
    {
        $this->permission->deleteAll(explode(',', $ids));
        return [
            'status' => trans('messages.delete.success'),
            'type' => 'success'
        ];
    }


}
