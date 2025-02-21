<?php

namespace App\Services\Interfaces\CrudInterfaces;

use Illuminate\Database\Eloquent\Model;

interface UpdateInterface
{
    public function updateAction(int $id, array $data): Model;
}
