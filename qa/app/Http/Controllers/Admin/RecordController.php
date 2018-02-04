<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Repositories\RecordRepository as Record;
use App\Http\Requests\RecordRequest;
use Datatables;

class RecordController extends Controller {

    private $record;

    public function __construct(Record $record)
    {
        $this->record = $record;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of($this->record->all())
            ->addColumn('action', function($model) { return $this->record->actionButttons($model);})
            ->editColumn('status',function($model) {if($model->status==1){return '<b style="color:green;">胜</b>';}elseif($model->status==2){return '<b style="color:orange;">平</b>';}elseif($model->status==3){return '<b style="color:red;">负</b>';}})
            ->make(true);
        }
        $html = $this->record->columns();
        return view('layout.partials.datatable',compact('html'));
    }

    public function create(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\RecordForm', [
            'method' => 'POST',
            'url' => route('admin.records.store')
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function store(RecordRequest $request)
    {    
        $data = $request->all();
        $data['user_id'] =  auth()->user()->id;
        $record = $this->record->save(null, $data);
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }        $route = ($request->get('task')=='apply') ? route('admin.records.edit', $record->id) : route('admin.records.index');
        return redirect($route)->with([
            'status' => trans('messages.saved'),
            'type-status' => 'success'
        ]);
    }

    public function show($id)
    {
        $record = $this->record->find($id);
        return view('records.show', compact('record'));
    }

    public function edit($id, Request $request, FormBuilder $formBuilder)
    {
        $record = $this->record->find($id);
        $form = $formBuilder->create('App\Forms\RecordForm', [
            'model' => $record,
            'method' => 'PUT',
            'url' => route('admin.records.update', $id)
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function update($id, RecordRequest $request)
    {
        $this->record->save($id, $request->all());
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }        $route = ($request->get('task')=='apply') ? route('admin.records.edit', $id) : route('admin.records.index');
        return redirect($route)->with([
            'status' => trans('messages.saved'),
            'type-status' => 'success'
        ]);
    }

    public function destroy($ids)
    {
        $this->record->deleteAll(explode(',', $ids));
        return [
            'status' => trans('messages.delete.success'),
            'type' => 'success'
        ];
    }

}
