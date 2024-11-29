<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ApiBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
            'status' => 200
        ];
        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendErrorResponse($error, $errorMessages = [], $code = 400)
    {
    	$response = [
            'success' => false,
            'message' => $error,
            'status' => 400
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    public function sendMessageResponse($message)
    {
    	$response = [
            'success' => true,
            'message' => $message,
            'status' => 200
        ];
        return response()->json($response, 200);
    }

    public function sendErrorMessageResponse($message)
    {
    	$response = [
            'success' => false,
            'message' => $message,
            'status' => 400
        ];
        return response()->json($response, 400);
    }
}
