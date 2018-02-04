<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model {
    use SoftDeletes;
    protected $table = 'member';
    protected $fillable = ['nickname', 'avatar', 'score', 'count', 'win_count', 'lose_count', 'draw_count'];

    public $datatable_fields = [
        'id'         => ['orderable' => true,  'searchable' => false],
        'nickname'   => ['orderable' => false, 'searchable' => true],
        'avatar'     => ['orderable' => false, 'searchable' => false],
        'score'      => ['orderable' => true,  'searchable' => true],
        'count'      => ['orderable' => true,  'searchable' => false],
        'win_count'  => ['orderable' => true,  'searchable' => false],
        'lose_count' => ['orderable' => true,  'searchable' => false],
        'draw_count' => ['orderable' => true,  'searchable' => false],
        'created_at' => ['orderable' => true,  'searchable' => false]
    ];
}