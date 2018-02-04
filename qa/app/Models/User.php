<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Models\Traits\Access;
use Jenssegers\Date\Date;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Access;

    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public $datatable_fields = [
        'id'         => ['orderable' => true,'searchable' => false],
        'name'      => ['orderable' => true,'searchable' => true],
        'email'      => ['orderable' => true,'searchable' => true],
        'created_at' => ['orderable' => true,'searchable' => false],
        'updated_at' => ['orderable' => true,'searchable' => false],
    ];


    public function getFromAttribute()
    {
        return Date::parse($this->created_at)->format('M. Y');
    }


    public function getCreatedAttribute()
    {
        return Date::parse($this->created_at)->format('d-m-Y');
    }

    public function getAvatarAttribute()
    {
        return $path = asset('logo.jpg');;
        // return "http://www.gravatar.com/avatar/".md5($this->email);
    }

    public function isAdmin()
    {
        return ($this->id == 1);
    }


    public function checkPermission($perm)
    {
        $permissions = $this->getAllPernissionsFormAllRoles();
        $permissionArray = is_array($perm) ? $perm : [$perm];
        return count(array_intersect($permissions, $permissionArray))>0;
    }


    protected function getAllPernissionsFormAllRoles()
    {
        $permissionsArray = [];
        $permissions = $this->roles->load('permissions')->fetch('permissions')->toArray();
        return array_map('strtolower', array_unique(array_flatten(array_map(function ($permission) {
            return array_fetch($permission, 'name');
        }, $permissions))));
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasPermission($permission)
    {
        dd($this->permissions);
    }

    public static function checkLogin($name,$password)
    {
        echo 1;
    }
}
