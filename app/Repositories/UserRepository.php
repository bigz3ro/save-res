<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    public function create($data = [])
    {
        $user = new User;
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->fullname = $data['fullname'];

        if (!$user->save()) {
            return null;
        }
        return $user;
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
                $query->where('email', 'like', '%'. $options['keyword'] . '%')->orWhere('name', 'like', '%'. $options['keyword'] . '%');
            }
        }

        return $query;
    }
}
