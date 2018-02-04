<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model {
    use SoftDeletes;
    protected $table = 'question';
    protected $fillable = ['cate_id', 'title', 'score', 'create_user_id', 'update_user_id'];

    public $datatable_fields = [
        'id'             => ['orderable' => false, 'searchable' => false],
        'cate_id'        => ['orderable' => false, 'searchable' => false],
        'title'          => ['orderable' => false, 'searchable' => false],
        'score'          => ['orderable' => false, 'searchable' => false],
        'create_user_id' => ['orderable' => false, 'searchable' => false],
        'update_user_id' => ['orderable' => false, 'searchable' => false],
        'created_at'     => ['orderable' => true,  'searchable' => false]
    ];

    public function cate()
    {
        return $this->belongsTo(Cate::class, 'cate_id');
    }

    public function userCreate()
    {
        return $this->belongsTo(User::class, 'create_user_id');
    }

    public function userUpdate()
    {
        return $this->belongsTo(User::class, 'update_user_id');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'question_id');
    }
}