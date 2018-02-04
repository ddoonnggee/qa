<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model {
    use SoftDeletes;
    protected $table = 'Answer';
    protected $fillable = ['question_id', 'option', 'is_right', 'create_user_id', 'update_user_id'];

    public $datatable_fields = [
        'id'             => ['orderable' => false, 'searchable' => false],
        'question_id'    => ['orderable' => true,  'searchable' => true],
        'option'         => ['orderable' => false, 'searchable' => false],
        'is_right'       => ['orderable' => false, 'searchable' => false],
        'create_user_id' => ['orderable' => false, 'searchable' => false],
        'update_user_id' => ['orderable' => false, 'searchable' => false],
        'created_at'     => ['orderable' => true,  'searchable' => false]
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function userCreate()
    {
        return $this->belongsTo(User::class, 'create_user_id');
    }

    public function userUpdate()
    {
        return $this->belongsTo(User::class, 'update_user_id');
    }
}