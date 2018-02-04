<?php namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{

    public function __construct(User $user)
    {
        $this->model = $user;
    }


    public function save($id, $data)
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user = parent::save($id, $data);

        //Assing user roles
        if (count($data['roles']) > 0) {
            $user->roles()->sync($data['roles']);
        }

        return $user;
    }
}
