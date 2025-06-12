<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function responseError($message, $code = 400){
        return throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => [ [$message] ],
        ], $code));
    }
}
