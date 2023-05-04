<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponseController as Response;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    public function getAll()
    {
        return Response::sendResponse(ProductRepository::getAll() ?? []);
    }
}
