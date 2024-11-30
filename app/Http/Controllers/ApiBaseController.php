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
    public function sendErrorResponse($error = null, $errorMessage = null, $code = 200)
    {
    	$response = [
            'success' => false,
            'message' => $errorMessage,
            'validate_error_message' => $error,
            'status' => 400
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }


}
