<?php

namespace App\Services\Interfaces\CrudInterfaces;

interface IndexInterface
{
    public function getIndexData(array $params = []): array;

}
