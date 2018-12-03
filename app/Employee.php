<?php

namespace App;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model implements AuthenticatableContract
{
    use Authenticatable;
    protected $table = 'employees';
    //

    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }
}
