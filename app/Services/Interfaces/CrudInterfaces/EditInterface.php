<?php

namespace App\Services\Interfaces\CrudInterfaces;

interface EditInterface
{
    public function getEditData(int $id): array;
}
