<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Repositories\PermissionGroupRepository as PermissionGroup;
use App\Http\Requests\PermissionGroup\PermissionGroupRequest;
use App\Http\Requests\PermissionGroup\SortPermissionGroupRequest;
use Datatables;

class PermissionGroupController extends Controller {

    private $permissiongroup;

    public function __construct(PermissionGroup $permissiongroup)
    {
        $this->permissiongroup = $permissiongroup;
    }

    public function index()
    {
        $groups      = $this->permissiongroup->getAllGroups();
        $groups_hierarchy =  $this->permissiongroup->getHierarchy($groups);
        return view('rbac.permission_groups', compact('groups_hierarchy'));
    }

    public function buildTree()
    {
        $groups = $this->permissiongroup->getAllGroups();
        return  $this->permissiongroup->getTree($groups);
    }

    public function create(Request $request,FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\PermissionGroupForm', [
            'method' => 'POST',
            'url' => route('admin.permissiongroups.store')
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function store(PermissionGroupRequest $request)
    {
        $permissiongroup = $this->permissiongroup->save(null, $request->all());
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }
        $route = ($request->get('task')=='apply') ? route('admin.permissiongroups.edit', $permissiongroup->id) : route('admin.permissiongroups.index');
        return redirect($route)->with([
            'status' => trans('messages.saved'),
            'type-status' => 'success'
        ]);
    }

    public function edit($id, Request $request, FormBuilder $formBuilder)
    {
        $permissiongroup = $this->permissiongroup->find($id);
        $form = $formBuilder->create('App\Forms\PermissionGroupForm', [
            'model'        => $permissiongroup,
            'method'       => 'PUT',
            'autocomplete' => 'off',
            'url'          => route('admin.permissiongroups.update', $id)
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function update($id, PermissionGroupRequest $request)
    {
        $this->permissiongroup->save($id, $request->all());
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }
        $route = ($request->get('task')=='apply') ? route('admin.permissiongroups.edit', $id) : route('admin.permissiongroups.index');
        return redirect($route)->with([
            'status' => trans('messages.saved'),
            'type' => 'success'
        ]);
    }

    public function updateSort(SortPermissionGroupRequest $request) {
        $this->permissiongroup->updateSort($request->get('data'));
        return response()->json(['status' => 'OK']);
    }

    public function destroy($id)
    {
        if($this->permissiongroup->find($id)->permissions->count()){
            return [
                'status' => trans('messages.permission_delete_error'),
                'text' => trans('messages.permission_delete_messages'),
                'type' => 'error',
            ];
        }
        if($this->permissiongroup->find($id)->children->count()){
            return [
                'status' => trans('messages.group_delete_error'),
                'text' => trans('messages.group_delete_messages'),
                'type' => 'error',
            ];
        }
        $this->permissiongroup->deleteAll($id);
        return [
            'status' => trans('messages.delete.success'),
            'text' => trans('messages.autoclose'),
            'type' => 'success',
        ];
    }

}
