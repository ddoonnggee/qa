<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Repositories\AnswerRepository as Answer;
use App\Http\Requests\AnswerRequest;
use Datatables;

class AnswerController extends Controller {

    private $answer;

    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
        $this->path     = 'admin.answer.';
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of($this->answer->all())
            ->addColumn('action', function($model) { return '<a class="btn btn-primary btn-xs btn-edit" href="'.url('admin/answer/'.$model->id.'/edit').'" data-id="'.$model->id.'" data-toggle="tooltip" title="'.trans('messages.edit').'" data-original-title="'.trans('messages.edit').'"><i class="fa fa-pencil"></i></a> <a class="btn btn-danger btn-xs btn-delete" data-toggle="tooltip"  data-id="'.$model->id.'" title="'.trans('messages.delete').'" data-original-title="'.trans('messages.delete').'"><i class="fa fa-trash"></i></a>';})
            ->editColumn('question_id', function($model) {return isset($model->question->title) ? $model->question->title : '';})
            ->editColumn('is_right', function($model) {return $model->is_right ? '<b style="color:green">正确</a>' : '错误';})
            ->editColumn('create_user_id', function($model) {return isset($model->userCreate->name) ? $model->userCreate->name : '';})
            ->editColumn('update_user_id', function($model) {return isset($model->userUpdate->name) ? $model->userUpdate->name : '';})
            ->make(true);
        }
        $html = $this->answer->columns();
        return view('layout.partials.datatable',compact('html'));
    }

    public function create(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\AnswerForm', [
            'method' => 'POST',
            'url'    => route($this->path.'store')
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function store(AnswerRequest $request)
    {    
        $data = $request->all();
        $data['create_user_id'] = auth()->user()->id;
        $data['update_user_id'] = auth()->user()->id;
        $answer = $this->answer->save(null, $data);
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type'   => 'success'
            ]);
        }
        $route = ($request->get('task')=='apply') ? route($this->path.'edit', $answer->id) : route($this->path.'index');
        return redirect($route)->with([
            'status'      => trans('messages.saved'),
            'type-status' => 'success'
        ]);
    }

    public function show($id)
    {
        $object = $this->answer->find($id);
        return view('answer.show', compact('object'));
    }

    public function edit($id, Request $request, FormBuilder $formBuilder)
    {
        $answer = $this->answer->find($id);
        $form = $formBuilder->create('App\Forms\AnswerForm', [
            'model'  => $answer,
            'method' => 'PUT',
            'url'    => route($this->path.'update', $id)
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function update($id, AnswerRequest $request)
    {
        $data = $request->all();
        $data['update_user_id'] = auth()->user()->id;
        $this->answer->save($id, $data);
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type'   => 'success'
            ]);
        }        $route = ($request->get('task')=='apply') ? route($this->path.'edit', $id) : route($this->path.'index');
        return redirect($route)->with([
            'status'      => trans('messages.saved'),
            'type-status' => 'success'
        ]);
    }

    public function destroy($ids)
    {
        $this->answer->deleteAll(explode(',', $ids));
        return [
            'status' => trans('messages.delete.success'),
            'type'   => 'success'
        ];
    }

}
