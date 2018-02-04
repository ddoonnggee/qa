<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository as Article;
use App\Http\Requests\ArticleRequest;
use Datatables;

class ArticleController extends Controller {

    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function index(Request $request)
    {
/*        $html = Datatables::of($this->article->all())
                    ->editColumn('author', function ($model) {
                        return isset($model->user->name)?$model->user->name:'';
                    })
                    ->addColumn('action', function($model) { return $this->article->actionButttons($model);})
                    ->make(true);
        return view('rbac.test',compact('html'));*/
        if ($request->ajax()) {
            return Datatables::of($this->article->all())
            ->editColumn('author', function ($model) {
                return isset($model->user->name)?$model->user->name:'';
            })
            ->addColumn('action', function($model) { return $this->article->actionButttons($model);})
            ->make(true);
        }
        $html = $this->article->columns();
        return view('layout.partials.datatable',compact('html'));
    }

    public function create(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\ArticleForm', [
            'method' => 'POST',
            'url' => route('admin.articles.store')
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function store(ArticleRequest $request)
    {
        $data = $request->all();
        $data['author'] =  auth()->user()->id;
        $article = $this->article->save(null,$data);
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }
        $route = ($request->get('task')=='apply') ? route('admin.articles.edit', $article->id) : route('admin.articles.index');
        return redirect($route)->with([
            'status' => trans('messages.saved'),
            'type' => 'success'
        ]);
    }

    public function show($id)
    {
        $article = $this->article->find($id);
        return view('articles.show', compact('article'));
    }

    public function edit($id, Request $request, FormBuilder $formBuilder)
    {
        $article = $this->article->find($id);
        // $user = Auth::loginUsingId(1);
        $this->authorize('articles_update', $article);
        $form = $formBuilder->create('App\Forms\ArticleForm', [
            'model' => $article,
            // 'method' => 'PATCH',
            'method' => 'PUT',
            'url' => route('admin.articles.update', $id)
        ]);
        return view($request->ajax()?'layout.partials.ajax_form':'layout.partials.form', compact('form'));
    }

    public function update($id, ArticleRequest $request)
    {
        $this->authorize('articles_update',$this->article->find($id));
        $data = $request->all();
        // $data['name'] =  '123';
        // $data['author'] =  Auth::id();
        // $post = $this->article->find($id);
        $this->article->save($id, $data);
        if($request->ajax()){
            return response()->json([
                'status' => trans('messages.saved'),
                'type' => 'success'
            ]);
        }
        $route = ($request->get('task')=='apply') ? route('admin.articles.edit', $id) : route('admin.articles.index');
        return redirect($route)->with([
            'status' => trans('messages.saved'),
            'type' => 'success'
        ]);
    }

    public function destroy($ids)
    {
        foreach (explode(',', $ids) as $id) {
            $this->authorize('articles_delete', $this->article->find($id));
        }
        $this->article->deleteAll(explode(',', $ids));
        return [
            'status' => trans('messages.delete.success'),
            'type' => 'success'
        ];
    }


}
