<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    public function create($data = [])
    {
        $user = new User;
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->fullname = $data['fullname'];
        $user->status = $data['status'];
        $user->organization_id = $data['organization_id'];
        if ($data['avatar']) {
            $user->avatar = $data['avatar'];
        }

        if (!$user->save()) {
            return null;
        }
        return $user;
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function getByEmail($email = null)
    {
        return User::where('email', $email)->first();
    }

    public function paginate($options = [], $take= 10)
    {
        $query = $this->query($options);
        $query->orderBy('id', 'desc');

        return $query->paginate($take);
    }

    public function query($options)
    {
        $query = User::query();
        if (!empty($options['keyword'])) {
            if (is_numeric($options['keyword'] )) {
                $query->where('id', $options['keyword']);
            } else {
                $query->where('email', 'like', '%'. $options['keyword'] . '%')
                    ->orWhere('fullname', 'like', '%'. $options['keyword'] . '%')
                    ->whereHas('organization', function ($q) use ($options) {
                        $q->where('name', 'like', '%'.$options['keyword']. '%');
                    })
                    ->whereHas('roles', function ($q) use ($options) {
                        $q->where('name', 'like', '%'.$options['keyword']. '%');
                    });
            }
        }

        return $query;
    }

    public function update(User $user, $data)
    {
        if (isset($data['fullname'])) {
            $user->fullname = $data['fullname'];
        }
        if (isset($data['email'])) {
            $user->email = $data['email'];
        }
        if (isset($data['status'])) {
            $user->status = $data['status'];
        }
        if (isset($data['avatar'])) {
            $user->avatar = $data['avatar'];
        }
        if (isset($data['organization_id'])) {
            $user->organization_id = $data['organization_id'];
        }
        if ($user->save()) {
            return $user;
        }
        return false;
    }

}
