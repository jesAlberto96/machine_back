<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public static function getAll()
    {
        return Product::get();
    }

    public static function getByWhere($where)
    {
        return Product::where($where)->first();
    }

    public static function update($model, $data)
    {
        return $model->update($data);
    }
}
