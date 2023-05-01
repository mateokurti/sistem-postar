<?php

namespace App\Models;


class Office extends _BaseModel
{
    protected $table = 'offices';

    public function getById($id)
    {
        return $this->getBy('id', $id);
    }
}
