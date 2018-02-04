<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository as Role;
use App\Http\Requests\RoleRequest;
use Datatables;

class RoleController extends Controller {

    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of($this->role->all())
            ->addColumn('action', function($model) { return $this->role->actionButttons($model);})
            ->make(true);
        }
        $html = $this->role->columns();
        return view('layout.partials.datatable',compact('html'));
    }

    public function create(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\RoleForm', [
            'method' => 'POST',
            'url' => route('admin.roles.store')
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function store(RoleRequest $request)
    {
        $role = $this->role->save(null, $request->all());
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }
        $route = ($request->get('task')=='apply') ? route('admin.roles.edit', $role->id) : route('admin.roles.index');
            return redirect($route)->with([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
    }

    public function show($id)
    {
        $role = $this->role->find($id);
        return view('rbac.role', compact('role'));
    }

    public function edit($id,Request $request,  FormBuilder $formBuilder)
    {
        $role = $this->role->find($id);
        $form = $formBuilder->create('App\Forms\RoleForm', [
            'model' => $role,
            'method' => 'PUT',
            'url' => route('admin.roles.update', $id)
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function update($id, RoleRequest $request)
    {
        $this->role->save($id, $request->all());
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }
        $route = ($request->get('task')=='apply') ? route('admin.roles.edit', $id) : route('admin.roles.index');
        return redirect($route)->with([
            'status' => trans('messages.saved'),
            'type' => 'success'
        ]);
    }

    public function destroy($ids)
    {
        $this->role->deleteAll(explode(',', $ids));
        return [
            'status' => trans('messages.delete.success'),
            'type' => 'success'
        ];
    }

}
