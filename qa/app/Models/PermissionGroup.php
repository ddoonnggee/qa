<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    protected $fillable = ['parent_id','name','sort'];

    public $route_resource = 'permissiongroups';


    public function setParentIdAttribute($value){
        if (empty($value)){
        	$this->attributes['parent_id'] = null;
        }else{
        	$this->attributes['parent_id'] = $value;
        }
    }

    public function children() {
        return $this->hasMany(PermissionGroup::class, 'parent_id', 'id')->orderBy('sort', 'asc');
    }

    public function permissions() {
        return $this->hasMany(Permission::class, 'group_id')->orderBy('sort', 'asc');
    }

}