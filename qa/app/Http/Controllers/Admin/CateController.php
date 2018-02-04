<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Repositories\CateRepository as Cate;
use App\Http\Requests\CateRequest;
use Datatables;

class CateController extends Controller {

    private $cate;

    public function __construct(Cate $cate)
    {
        $this->cate = $cate;
        $this->path = 'admin.cate.';
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of($this->cate->all())
            ->addColumn('action', function($model) { return $this->cate->actionButttons($model);})
            ->editColumn('create_user_id', function($model) {return isset($model->userCreate->name) ? $model->userCreate->name : '';})
            ->editColumn('update_user_id', function($model) {return isset($model->userUpdate->name) ? $model->userUpdate->name : '';})
            ->make(true);
        }
        $html = $this->cate->columns();
        return view('layout.partials.datatable',compact('html'));
    }

    public function create(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\CateForm', [
            'method' => 'POST',
            'url' => route($this->path.'store')
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function store(CateRequest $request)
    {    
        $data = $request->all();
        $data['create_user_id'] = auth()->user()->id;
        $data['update_user_id'] = auth()->user()->id;
        $cate = $this->cate->save(null, $data);
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }
        $route = ($request->get('task')=='apply') ? route($this->path.'edit', $cate->id) : route($this->path.'index');
        return redirect($route)->with([
            'status' => trans('messages.saved'),
            'type-status' => 'success'
        ]);
    }

    public function show($id)
    {
        $object = $this->cate->find($id);
        return view('cate.show', compact('object'));
    }

    public function edit($id, Request $request, FormBuilder $formBuilder)
    {
        $cate = $this->cate->find($id);
        $form = $formBuilder->create('App\Forms\CateForm', [
            'model' => $cate,
            'method' => 'PUT',
            'url' => route($this->path.'update', $id)
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function update($id, CateRequest $request)
    {
        $data = $request->all();
        $data['update_user_id'] = auth()->user()->id;
        $this->cate->save($id, $data);
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }        $route = ($request->get('task')=='apply') ? route($this->path.'edit', $id) : route($this->path.'index');
        return redirect($route)->with([
            'status' => trans('messages.saved'),
            'type-status' => 'success'
        ]);
    }

    public function destroy($ids)
    {
        $this->cate->deleteAll(explode(',', $ids));
        return [
            'status' => trans('messages.delete.success'),
            'type' => 'success'
        ];
    }

}
