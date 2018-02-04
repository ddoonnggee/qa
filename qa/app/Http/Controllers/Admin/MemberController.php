<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Repositories\MemberRepository as Member;
use App\Http\Requests\MemberRequest;
use Datatables;

class MemberController extends Controller {

    private $member;

    public function __construct(Member $member)
    {
        $this->member = $member;
        $this->path = 'admin.member.';
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of($this->member->all())
            ->addColumn('action', function($model) { return $this->member->actionButttons($model);})
            ->editColumn('avatar', function($model) { return $model->avatar ? '<img src="'.$model->avatar.'" height=24>' : '';})
            ->make(true);
        }
        $html = $this->member->columns();
        return view('layout.partials.datatable',compact('html'));
    }

    public function create(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\MemberForm', [
            'method' => 'POST',
            'url' => route($this->path.'store')
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function store(MemberRequest $request)
    {    
        $data = $request->all();
        $data['create_user_id'] = auth()->user()->id;
        $data['update_user_id'] = auth()->user()->id;
        $member = $this->member->save(null, $data);
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }
        $route = ($request->get('task')=='apply') ? route($this->path.'edit', $member->id) : route($this->path.'index');
        return redirect($route)->with([
            'status' => trans('messages.saved'),
            'type-status' => 'success'
        ]);
    }

    public function show($id)
    {
        $object = $this->member->find($id);
        return view('member.show', compact('object'));
    }

    public function edit($id, Request $request, FormBuilder $formBuilder)
    {
        $member = $this->member->find($id);
        $form = $formBuilder->create('App\Forms\MemberForm', [
            'model' => $member,
            'method' => 'PUT',
            'url' => route($this->path.'update', $id)
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function update($id, MemberRequest $request)
    {
        $data = $request->all();
        $data['update_user_id'] = auth()->user()->id;
        $this->member->save($id, $data);
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
        $this->member->deleteAll(explode(',', $ids));
        return [
            'status' => trans('messages.delete.success'),
            'type' => 'success'
        ];
    }

}
