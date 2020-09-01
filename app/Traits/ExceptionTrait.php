<?php

namespace App\Traits;

use App\Http\Controllers\HelperController;
use BadMethodCallException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

trait ExceptionTrait
{
    use ApiResponser;

    public function apiException($e, $request)
    {
        if ($e instanceof ValidationException) {
            return $this->returnValidationErrors($e);
        } elseif ($e instanceof ModelNotFoundException) {
            $model_name = strtolower(class_basename($e->getModel()));
            return $this->errorMessage("Dose not exists any $model_name with the specific identifier", 404);
        } elseif ($e instanceof AuthorizationException) {
            return $this->errorMessage($e->getMessage(), 403);
        } elseif ($e instanceof NotFoundHttpException) {
            return $this->errorMessage('The specified url can not be found', 404);
        } elseif ($e instanceof MethodNotAllowedHttpException) {
            return $this->errorMessage('The specified method for the request in invalid', 405);
        } elseif ($e instanceof HttpException) {
            return $this->errorMessage($e->getMessage(), $e->getStatusCode());
        } elseif ($e instanceof TokenExpiredException) {
            return $this->errorMessage('Expired refresh token', 422);
        } elseif ($e instanceof JWTException) {
            return $this->errorMessage($e->getMessage(), 422);
        } elseif ($e instanceof QueryException) {
            $error_code = $e->errorInfo[1];
            if ($error_code === 1451) {
                return $this->errorMessage('Can not remove this resource permanently. It is related with other resource', 409);
            }
        }

        if (config('app.debug')) {
            return parent::render($request, $e);
        }

        return $this->errorMessage('Unexpected Exception. Try later', 500);
    }

    public function returnValidationErrors($e)
    {
        $errors = array_map(function ($item) {
            return $item[0];
        }, $e->errors());

        return $this->validationResponse(['errors' => $errors], 422);
    }
}
