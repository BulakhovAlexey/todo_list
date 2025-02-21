<?php

namespace App\Services\Interfaces\CrudInterfaces;

use Illuminate\Database\Eloquent\Model;

interface StoreInterface
{
    public function storeAction(array $data): Model;
}
