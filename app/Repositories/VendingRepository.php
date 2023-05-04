<?php

namespace App\Repositories;

use App\Models\Vending;

class VendingRepository
{
    public static function create($data)
    {
        return Vending::create($data);
    }
}
