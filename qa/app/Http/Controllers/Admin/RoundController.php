<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Repositories\RoundRepository as Round;
use App\Models\Record;
use Datatables;

class RoundController extends Controller {

    private $round;

    public function __construct(Round $round)
    {
        $this->round = $round;
        $this->path = 'admin.round.';
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of($this->round->all())
            ->addColumn('action', function($model) { return '<a class="btn btn-warning btn-xs btn-show" href="'.url('admin/round/'.$model->id).'" data-id="'.$model->id.'" data-toggle="tooltip" title="'.trans('messages.show').'" data-original-title="'.trans('messages.show').'"><i class="fa fa-eye"></i></a>';})
            ->editColumn('home_member_id', function($model) {return isset($model->memberHome->nickname) ? $model->memberHome->nickname : '';})
            ->editColumn('away_member_id', function($model) {return isset($model->memberAway->nickname) ? $model->memberAway->nickname : '';})
            ->editColumn('win_member_id', function($model) {return isset($model->memberWin->nickname) ? '<b style="color:green">'.$model->memberWin->nickname.'</b>' : '平局';})
            ->make(true);
        }
        $html = $this->round->columns();
        $no_toolbars = 1;
        return view('layout.partials.datatable',compact('html', 'no_toolbars'));
    }

    public function show($id)
    {
        $object = $this->round->find($id);
        $list   = Record::where('round_id', $id)->get();

        return view('round.show', compact('object', 'list'));
    }
}
