<?php

namespace App\Repositories;

use App\Models\Coin;

class CoinRepository
{
    public static function getAll()
    {
        return Coin::get();
    }

    public static function getByWhere($where)
    {
        return Coin::where($where)->first();
    }

    public static function getAllByWhere($where)
    {
        return Coin::where($where)->get();
    }

    public static function update($model, $data)
    {
        return $model->update($data);
    }
}
