<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cate extends Model {
    use SoftDeletes;
    protected $table = 'cate';
    protected $fillable = ['name', 'create_user_id', 'update_user_id'];

    public $datatable_fields = [
        'id'             => ['orderable' => false, 'searchable' => false],
        'name'           => ['orderable' => false, 'searchable' => false],
        'create_user_id' => ['orderable' => false, 'searchable' => false],
        'update_user_id' => ['orderable' => false, 'searchable' => false],
        'created_at'     => ['orderable' => true,  'searchable' => false]
    ];

    public function userCreate()
    {
        return $this->belongsTo(User::class, 'create_user_id');
    }

    public function userUpdate()
    {
        return $this->belongsTo(User::class, 'update_user_id');
    }
}