<?php

namespace App\Repositories;

use App\Role;

class RoleRepository
{
    public function paginate($options = [], $take= 10)
    {
        $query = $this->query($options);
        $query->orderBy('id', 'desc');

        return $query->paginate($take);
    }

    public function query($options)
    {
        $query = Role::query();
        if (!empty($options['keyword'])) {
            if (is_numeric($options['keyword'] )) {
                $query->where('id', $options['keyword']);
            } else {
                $query->where('name', 'like', '%'. $options['keyword'] . '%')->orWhere('display_name', 'like', '%'. $options['keyword'] . '%');
            }
        }

        return $query;
    }
}
