<?php

namespace App\Services\Interfaces\CrudInterfaces;

interface ShowInterface
{
    public function getShowData(int $id): array;
}
