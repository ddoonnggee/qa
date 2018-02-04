<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Repositories\QuestionRepository as Question;
use App\Http\Requests\QuestionRequest;
use App\Models\Answer;
use Datatables;

class QuestionController extends Controller {

    private $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
        $this->path     = 'admin.question.';
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of($this->question->all())
            ->addColumn('action', function($model) { return $this->question->actionButttons($model);})
            ->editColumn('cate_id', function($model) {return isset($model->cate->name) ? $model->cate->name : '';})
            ->editColumn('create_user_id', function($model) {return isset($model->userCreate->name) ? $model->userCreate->name : '';})
            ->editColumn('update_user_id', function($model) {return isset($model->userUpdate->name) ? $model->userUpdate->name : '';})
            ->make(true);
        }
        $html = $this->question->columns();
        return view('layout.partials.datatable',compact('html'));
    }

    public function create(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\QuestionForm', [
            'method' => 'POST',
            'url'    => route($this->path.'store')
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function store(QuestionRequest $request)
    {    
        $data = $request->all();
        $data['create_user_id'] = auth()->user()->id;
        $data['update_user_id'] = auth()->user()->id;
        $question = $this->question->save(null, $data);
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type'   => 'success'
            ]);
        }
        $route = ($request->get('task')=='apply') ? route($this->path.'edit', $question->id) : route($this->path.'index');
        return redirect($route)->with([
            'status'      => trans('messages.saved'),
            'type-status' => 'success'
        ]);
    }

    public function show($id)
    {
        $object = $this->question->find($id);
        $list   = Answer::where('question_id', $id)->get();

        return view('question.show', compact('object', 'list'));
    }

    public function edit($id, Request $request, FormBuilder $formBuilder)
    {
        $question = $this->question->find($id);
        $form = $formBuilder->create('App\Forms\QuestionForm', [
            'model'  => $question,
            'method' => 'PUT',
            'url'    => route($this->path.'update', $id)
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function update($id, QuestionRequest $request)
    {
        $data = $request->all();
        $data['update_user_id'] = auth()->user()->id;
        $this->question->save($id, $data);
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
        $this->question->deleteAll(explode(',', $ids));
        return [
            'status' => trans('messages.delete.success'),
            'type'   => 'success'
        ];
    }

}
