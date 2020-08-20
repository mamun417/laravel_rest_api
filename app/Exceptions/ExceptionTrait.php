<?php

namespace App\Exceptions;

use App\Http\Controllers\HelperController;
use BadMethodCallException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

trait ExceptionTrait
{
    public function apiException($e, $request)
    {
        if ($e instanceof ValidationException) {
            return $this->returnValidationErrors($e);
        }
        if ($e instanceof ModelNotFoundException) {
            return HelperController::apiResponse(404, $e->getMessage());
        } elseif ($e instanceof NotFoundHttpException) {
            return HelperController::apiResponse(404, 'Route not found');
        } elseif ($e instanceof MethodNotAllowedHttpException) {
            return HelperController::apiResponse(404, $e->getMessage());
        } elseif ($e instanceof BadMethodCallException) {
            return HelperController::apiResponse(404, $e->getMessage());
        } elseif ($e instanceof TokenExpiredException) {
            return HelperController::apiResponse(422, 'Expired refresh token');
        } elseif ($e instanceof JWTException) {
            return HelperController::apiResponse(422, $e->getMessage());
        }

        return parent::render($request, $e);
    }

    public function returnValidationErrors($e)
    {
        $errors = array_map(function ($item) {
            return $item[0];
        }, $e->errors());

        return HelperController::apiResponse(422, '', 'errors', $errors);
    }
}
