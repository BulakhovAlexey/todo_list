<?php

namespace App\Services\Interfaces\CrudInterfaces;

interface DeleteInterface
{
    public function deleteAction(int $id): void;
}
