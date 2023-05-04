<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponseController as Response;
use App\Repositories\VendingRepository;
use App\Repositories\ProductRepository;
use App\Repositories\CoinRepository;

class VendingController extends Controller
{
    public function store(Request $request)
    {
        // return number_format(array_sum($request->coins), 2);
        $total_coins = number_format(array_sum($request->coins), 2);
        $product = $this->getProduct($request->product_id);
        if (is_null($product)){
            return Response::sendError("No se pudo completar esta solicitud", 409, [
                "code" => 1 //code to there is not product
            ]);
        }

        if (array_sum($request->coins) < $product->price){
            return Response::sendError("No se pudo completar esta solicitud", 409, [
                "code" => 2 //code to money insufficient
            ]);
        } else {
            $change = number_format(($total_coins - $product->price), 2);

            $coins = CoinRepository::getAllByWhere(array(
                ['cant', '>', 0],
                ['coin', '<=', $change]
            ));
        }


return $coins;
        $this->updateCoins($request->coins);

        return Response::sendResponse($product);
        return Response::sendResponse(VendingRepository::create() ?? []);
    }

    private function getProduct($product_id){
        return ProductRepository::getByWhere(array(
            ["id", $product_id],
            ["cant", '>', 0],
        ));
    }

    private function updateCoins($coins){
        foreach ($coins as $key => $coin) {
            $model_coin = CoinRepository::getByWhere(array(
                ['coin', $coin]
            ));

            $model_coin = CoinRepository::update($model_coin, [
                'cant' => ($model_coin->cant + 1)
            ]);
        }

        return true;
    }
}
