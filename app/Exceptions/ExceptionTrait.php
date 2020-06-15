<?php

namespace App\Exceptions;

use App\Http\Controllers\HelperController;
use BadMethodCallException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait {

    public function apiException($e, $request)
    {
        if ($e instanceof ModelNotFoundException){
            return HelperController::formattedResponse(false, 404, $e->getMessage());
        }elseif ($e instanceof NotFoundHttpException){
            return HelperController::formattedResponse(false, 404, 'Route not found');
        }elseif ($e instanceof MethodNotAllowedHttpException){
            return HelperController::formattedResponse(false, 404, $e->getMessage());
        }elseif ($e instanceof BadMethodCallException){
            return HelperController::formattedResponse(false, 404, $e->getMessage());
        }

        return parent::render($request, $e);
    }
}
