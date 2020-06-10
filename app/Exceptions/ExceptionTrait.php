<?php

namespace App\Exceptions;

use App\Http\Controllers\HelperController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait {

    public function apiException($e, $request)
    {
        if ($e instanceof ModelNotFoundException){
            return HelperController::formattedResponse(false, 404, $e->getMessage());
        }

        if ($e instanceof NotFoundHttpException){
            return HelperController::formattedResponse(false, 404, 'Route not found');
        }

        return parent::render($request, $e);
    }
}
