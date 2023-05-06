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
        $product = $this->getProduct($request->product_id);

        if (!$this->validateBuy($request, $product)){
            return Response::sendError($this->errors['msg'], 409, [
                "code" => $this->errors['code'] //code to there is not product
            ]);
        }

        ProductRepository::update($product, [
            "amount" => ($product->amount - 1)
        ]);

        $this->updateCoins($request->coins);

        return Response::sendResponse(
            array(
                "product" => $product,
                "change" => [
                    "coin" => $this->data_change["coin"],
                    "total_coins" => $this->data_change["total_coins"],
                ]
            )
        );
    }

    private function validateBuy($request, $product){
        $total_coins = number_format(array_sum($request->coins), 2);

        if (is_null($product)){
            $this->errors = array("msg" => "There is no this product", "code" => 1); //code to there is not product
            return false;
        }

        if (array_sum($request->coins) < $product->price){
            $this->errors = array("msg" => "Money insufficient", "code" => 2); //code to money insufficient
            return false;
        } else {
            $change = number_format(($total_coins - $product->price), 2);
            $coins = CoinRepository::getAllByWhere(array(
                ['amount', '>', 0],
                ['coin', '<=', $change]
            ));

            $this->data_change = $this->getChange($coins, $change);
            if (!$this->data_change){
                $this->errors = array("msg" => "Change insufficient", "code" => 3); //code to there is not change
                return false;
            }
        }

        return true;
    }

    private function getProduct($product_id){
        return ProductRepository::getByWhere(array(
            ["id", $product_id],
            ["amount", '>', 0],
        ));
    }

    private function updateCoins($coins){
        foreach ($coins as $key => $coin) {
            $model_coin = CoinRepository::getByWhere(array(
                ['coin', $coin]
            ));

            $model_coin = CoinRepository::update($model_coin, [
                'amount' => ($model_coin->amount + 1)
            ]);
        }

        if ($this->data_change["total_coins"] != 0){
            CoinRepository::update($this->data_change["coin"], [
                "amount" => ($this->data_change["coin"]->amount - $this->data_change["total_coins"])
            ]);
        }

        return true;
    }

    private function getChange($coins, $change){
        if ($change == 0.00){ //Don´t need change
            return array("coin" => 0, "total_coins" => 0);
        } else {
            foreach ($coins as $key => $coin) {
                $coin_change = number_format(($change / $coin->coin), 2);
                if (!(fmod($coin_change, 1) !== 0.00)){
                    if ((int) $coin->amount >= intval($coin_change)){
                        return array("coin" => $coin, "total_coins" => intval($coin_change));
                    }
                }
            }
        }

        return false;
    }
}
