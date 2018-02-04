<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Permission extends Model
{
    protected $fillable = ['group_id','name', 'display_name','sort'];

    public $datatable_fields = [
        'id'                     => ['orderable' => true,'searchable' => false],
        'name'                   => ['orderable' => true,'searchable' => true],
        'display_name'           => ['orderable' => true,'searchable' => true],
        'group_id'               => ['orderable' => true,'searchable' => false],
        'sort'                   => ['orderable' => true,'searchable' => false],
        'permissiondependencies' => ['orderable' => false,'searchable' => false, 'except' => true],//远程表关联字段，禁止在当前表sql查询
        'updated_at'             => ['orderable' => true,'searchable' => false],
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function group() {
        return $this->belongsTo(PermissionGroup::class, 'group_id');
    }

    public function dependencies() {
        return $this->hasMany(PermissionDependency::class, 'permission_id', 'id');
    }


}
