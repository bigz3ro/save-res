<?php

namespace App\Repositories;

use App\Button;

class ButtonRepository
{
    public function create($data = [])
    {
        $obj = new Button;
        $obj->serial_number = $data['serial_number'];
        $obj->command = $data['command'];
        $obj->organization_id = $data['organization_id'];

        if (!$obj->save()) {
            return null;
        }
        return $obj;
    }

    public function find($id)
    {
        return Button::find($id);
    }

    public function paginate($options = [], $take= 10)
    {
        $query = $this->query($options);
        $query->orderBy('id', 'desc');

        return $query->paginate($take);
    }

    public function query($options)
    {
        $query = Button::query();
        if (!empty($options['keyword'])) {
            if (is_numeric($options['keyword'] )) {
                $query->where('id', $options['keyword']);
            } else {
                $query->where('serial_number', $options['keyword'])->orWhere('command', 'like', '%'. $options['keyword'] . '%');
            }
        }
        if ($options['organization_id']) {
            $query->where('organization_id', $options['organization_id']);
        }

        return $query;
    }

    public function update(Button $obj, $data)
    {
        if (isset($data['serial_number'])) {
            $obj->serial_number = $data['serial_number'];
        }
        if (isset($data['command'])) {
            $obj->command = $data['command'];
        }
        if ($obj->save()) {
            return $obj;
        }

        return false;
    }

}
