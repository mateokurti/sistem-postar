<?php

namespace App\Models;


class Employee extends _BaseModel
{
    protected $table = 'employees';

    public function getByIdentityId($identityId)
    {
        return $this->getBy('identity_id', $identityId);
    }
}
