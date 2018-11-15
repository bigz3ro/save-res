<?php

namespace App\Repositories;

use App\Employee;

class EmployeeRepository
{
    public function create($data = [])
    {
        $employee = new Employee;
        $employee->fullname = $data['fullname'];
        $employee->gender = $data['gender'];
        $employee->birthday = $data['birthday'];
        $employee->address = $data['address'];
        $employee->organization_id = $data['organization_id'];
        $employee->phone = $data['phone'];
        if ($data['cmnd']) {
            $employee->cmnd = $data['cmnd'];
        }
        if (!$employee->save()) {
            return null;
        }
        return $employee;
    }

    public function find($id)
    {
        return Employee::find($id);
    }

    public function paginate($options = [], $take= 10)
    {
        $query = $this->query($options);
        $query->orderBy('id', 'desc');

        return $query->paginate($take);
    }

    public function query($options)
    {
        $query = Employee::query();
        if (!empty($options['keyword'])) {
            if (is_numeric($options['keyword'] )) {
                $query->where('id', $options['keyword']);
            } else {
                $query->where('fullname', 'like', '%'. $options['keyword'] . '%')->orWhere('name', 'like', '%'. $options['keyword'] . '%');
            }
        }

        return $query;
    }

    public function update(Employee $employee, $data)
    {
        if (isset($data['fullname'])) {
            $employee->fullname = $data['fullname'];
        }
        if (isset($data['gender'])) {
            $employee->gender = $data['gender'];
        }
        if (isset($data['address'])) {
            $employee->address = $data['address'];
        }
        if (isset($data['phone'])) {
            $employee->phone = $data['phone'];
        }
        if (isset($data['cmnd'])) {
            $employee->cmnd = $data['cmnd'];
        }
        if (isset($data['birthday'])) {
            $employee->birthday = $data['birthday'];
        }
        if (isset($data['organization_id'])) {
            $employee->organization_id = $data['organization_id'];
        }
        if ($employee->save()) {
            return $employee;
        }
        return false;
    }

}
