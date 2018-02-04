<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository as User;
use App\Http\Requests\UserRequest;
use Datatables;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of($this->user->all())
            ->addColumn('action', function($model) { return $this->user->actionButttons($model);})
            ->make(true);
        }
        $html = $this->user->columns();
        return view('layout.partials.datatable',compact('html'));
    }

    public function create(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\UserForm', [
            'method' => 'POST',
            'url' => route('admin.users.store')
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function store(UserRequest $request)
    {
        $user = $this->user->save(null, $request->all());
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }
        $route = ($request->get('task')=='apply') ? route('admin.users.edit', $user->id) : route('admin.users.index');
        return redirect($route)->with([
            'status' => trans('messages.saved'),
            'type' => 'success'
        ]);
    }

    public function show($id)
    {
        $user = $this->user->find($id);
        return view('rbac.user', compact('user'));
    }

    public function edit($id, Request $request, FormBuilder $formBuilder)
    {
        $user = $this->user->find($id);
        $form = $formBuilder->create('App\Forms\UserForm', [
            'model' => $user,
            // 'method' => 'PATCH',
            'method' => 'PUT',
            'url' => route('admin.users.update', $id)
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function update($id, UserRequest $request)
    {
        $data = ($request->has('password')) ? $request->all() : $request->except('password');
        $this->user->save($id, $data);
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }
        $route = ($request->get('task')=='apply') ? route('admin.users.edit', $id) : route('admin.users.index');
        return redirect($route)->with([
            'status' => trans('messages.saved'),
            'type' => 'success'
        ]);
    }

    public function destroy($ids)
    {
        $this->user->deleteAll(explode(',', $ids));
        return [
            'status' => trans('messages.delete.success'),
            'type' => 'success'
        ];
    }

}
