<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class PermissionDependency extends Model
{
    protected $fillable = ['permission_id','dependency_id'];

    public function permission() {
        return $this->hasOne(Permission::class, 'id', 'dependency_id');
    }

}
