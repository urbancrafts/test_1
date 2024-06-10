<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    /**
        * success response method.
        *
        * @return \Illuminate\Http\Response
        */

        public function __construct(){
            //Buffering the output
         
       
     
   
       }

        public function sendResponse($result, $message)
        {
            $response = [
                'success' => true,
                'data'    => $result,
                'message' => $message,
            ];


            return response()->json($response, 200);
        }


        /**
        * return error response.
        *
        * @return \Illuminate\Http\Response
        */
        public function sendError($error, $errorMessages = [], $code)
        {
            $response = [
                'success' => false,
                'message' => $error,
            ];


            if(!empty($errorMessages)){
                $response['data'] = $errorMessages;
            }


            return response()->json($response, $code);
        }

        public function showErrorMsg($error, $errorMessages = [], $code){
            $response = [
                'success' => false,
                'message' => $error,
            ];


            if(!empty($errorMessages)){
                $response['data'] = $errorMessages;
            }

            return response()->json($response, $code); 
        }
    }
