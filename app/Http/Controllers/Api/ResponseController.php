<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ResponseController extends Controller
{

    static public function sendResponse($data, $message = "")
    {
    	$response = [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    static public function sendError($message, $code = 404, $errors = [])
    {
    	$response = [
            'success' => false,
            'message' => $message,
        ];

        if(!empty($errors)){
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}