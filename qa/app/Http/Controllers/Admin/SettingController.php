<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

use App\Http\Controllers\Controller;
use App\Repositories\SettingRepository as Setting;
use App\Http\Requests\SettingRequest;
use Datatables;

class SettingController extends Controller {

    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of($this->setting->all())
            ->addColumn('action', function($model) { return $this->setting->actionButttons($model);})
            ->make(true);
        }
        $html = $this->setting->columns();
        return view('layout.partials.datatable',compact('html'));
    }

    public function create(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\SettingForm', [
            'method' => 'POST',
            'url' => route('admin.settings.store')
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function store(SettingRequest $request)
    {
        $setting = $this->setting->save(null, $request->all());
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }        $route = ($request->get('task')=='apply') ? route('admin.settings.edit', $setting->id) : route('admin.settings.index');
        return redirect($route)->with([
            'status' => trans('messages.saved'), 
            'type' => 'success'
        ]);
    }

    public function show($id)
    {
        $setting = $this->setting->find($id);
        return view('settings.show', compact('setting'));
    }

    public function edit($id, Request $request, FormBuilder $formBuilder)
    {
        $setting = $this->setting->find($id);
        $form = $formBuilder->create('App\Forms\SettingForm', [
            'model' => $setting,
            'method' => 'PUT',
            'url' => route('admin.settings.update', $id)
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function update($id, SettingRequest $request)
    {
        $this->setting->save($id, $request->all());
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }        $route = ($request->get('task')=='apply') ? route('admin.settings.edit', $id) : route('admin.settings.index');
        return redirect($route)->with([
            'status' => trans('messages.saved'), 
            'type' => 'success'
        ]);
    }

    public function destroy($ids)
    {
        $this->setting->deleteAll(explode(',', $ids));
        return [
            'status' => trans('messages.delete.success'), 
            'type' => 'success'
        ];
    }


}
