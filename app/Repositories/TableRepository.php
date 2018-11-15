<?php

namespace App\Repositories;

use App\TableZone;

class TableRepository
{
    public function create($data = [])
    {
        $table = new TableZone;
        $table->name = $data['name'];
        $table->location = $data['location'];
        $table->description = $data['description'];

        if (!$table->save()) {
            return null;
        }
        return $table;
    }

    public function find($id)
    {
        return TableZone::find($id);
    }

    public function paginate($options = [], $take= 10)
    {
        $query = $this->query($options);
        $query->orderBy('id', 'desc');

        return $query->paginate($take);
    }

    public function query($options)
    {
        $query = TableZone::query();
        if (!empty($options['keyword'])) {
            if (is_numeric($options['keyword'] )) {
                $query->where('id', $options['keyword']);
            } else {
                $query->where('email', 'like', '%'. $options['keyword'] . '%')->orWhere('name', 'like', '%'. $options['keyword'] . '%');
            }
        }

        return $query;
    }

    public function update(TableZone $table, $data)
    {
        if (isset($data['name'])) {
            $table->name = $data['name'];
        }
        if (isset($data['location'])) {
            $table->location = $data['location'];
        }
        if (isset($data['description'])) {
            $table->description = $data['description'];
        }
        if ($table->save()) {
            return $table;
        }
        return false;
    }

}
