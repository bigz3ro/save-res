<?php

namespace App\Repositories;
use App\Role;
/**
 * Class RoleRepository.
 */
class RoleRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function find($id)
    {
        return Role::find($id);
    }

    public function paginate($options = [], $take = 10)
    {
        $query = $this->query($options);
        $query->orderBy('id', 'desc');

        return $query->paginate($take);
    }

    public function query($options = [])
    {
        $query = Role::query();
        if (!empty($options['keyword'])) {
            if (is_numeric($options['keyword'] )) {
                $query->where('id', $options['keyword']);
            } else {
                $query->where('name', 'like', '%'. $options['keyword'] . '%')->orWhere('display_name', 'like', '%'. $options['keyword'] . '%')->orWhere('description', 'like', '%'. $options['keyword'] . '%');
            }
        }

        return $query;
    }

    public function create($data = [])
    {
        $role = new Role;
        $role->name = $data['name'];
        $role->display_name = $data['display_name'];
        $role->description = $data['description'];

        if ($role->save()) {
            return $role;
        }

        return null;
    }

public function update(Role $role, $data = [])
    {
        $role->name = $data['name'];
        $role->display_name = $data['display_name'];
        $role->description = $data['description'];

        if ($role->save()) {
            return $role;
        }

        return null;
    }
}
