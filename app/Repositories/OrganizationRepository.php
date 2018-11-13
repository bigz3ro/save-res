<?php

namespace App\Repositories;

use App\Organization;

class OrganizationRepository
{
    public function paginate($options = [], $take= 10)
    {
        $query = $this->query($options);
        $query->orderBy('id', 'desc');

        return $query->paginate($take);
    }

    public function query($options)
    {
        $query = Organization::query();
        if (!empty($options['keyword'])) {
            if (is_numeric($options['keyword'] )) {
                $query->where('id', $options['keyword']);
            } else {
                $query->where('name', 'like', '%'. $options['keyword'] . '%')->orWhere('phone', 'like', '%'. $options['keyword'] . '%');
            }
        }

        return $query;
    }

    public function create($data = [])
    {
        $organization = new Organization;
        $organization->name = $data['name'];
        $organization->address = $data['address'];
        $organization->phone = $data['phone'];
        $organization->start_time = $data['start_time'];

        if (!$organization->save()) {
            return null;
        }
        return $organization;
    }

    public function update(Organization $organization, $data)
    {
        if (isset($data['name'])) {
            $organization->name = $data['name'];
        }
        if (isset($data['address'])) {
            $organization->address = $data['address'];
        }
        if (isset($data['phone'])) {
            $organization->phone = $data['phone'];
        }
        if (isset($data['start_time'])) {
            $organization->start_time = $data['start_time'];
        }
        if ($organization->save()) {
            return $organization;
        }
        return false;
    }
}
