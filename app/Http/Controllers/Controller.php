<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const STATUS_SUCCESSFUL = "successful";
    const STATUS_FAIL = "fail";
    
    protected function validateRequest($request, $rule, $messages = []) {
        $validator = Validator::make($request, $rule, $messages);
        if ($validator->fails()) {
            $stringMessage = [];
            foreach($validator->messages()->getMessages() as $fieldName => $msg) {
                foreach($msg as $item) {
                    $stringMessage[] = $item;
                }
            }
            return $stringMessage;
        }
        return true;
    }

    protected function getDefaultStatus($message = null, $code = 200) {
        $result = array();
        $result["status"] = self::STATUS_FAIL;
        $result["message"] = (!empty($message)) ? $message : 'Error!';
        $result["result"] = [];
        return response()->json($result, $code);
    }

    protected function getSuccessStatus($data = [], $meta = []) {
        $result['status'] = self::STATUS_SUCCESSFUL;
        $result['result'] = $data;
        if (!empty($meta)) $result['meta'] = $meta;
        
        return response()->json($result);
    }

    protected function rebuildValidateMessage ($messages) {
        $retVal = [];
        $messages = $messages->toArray();
        foreach ($messages as $key => $value) {
            $retVal[$key] = $value[0];
        }
        return $retVal;
    }
}
