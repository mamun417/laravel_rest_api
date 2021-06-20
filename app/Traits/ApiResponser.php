<?php

namespace App\Traits;

use Ramsey\Collection\Collection;

trait ApiResponser
{
    protected function successResponse($data, $code = 200): \Illuminate\Http\JsonResponse
    {
        $data = array_merge(['success' => true], $data);
        return response()->json($data, $code);
    }

    protected function successMessage($message, $code): \Illuminate\Http\JsonResponse
    {
        $data = ['success' => true, 'message' => $message];
        return response()->json($data, $code);
    }

    protected function errorMessage($message, $code): \Illuminate\Http\JsonResponse
    {
        $data = ['success' => false, 'message' => $message];
        return response()->json($data, $code);
    }

    protected function validationResponse($data, $code): \Illuminate\Http\JsonResponse
    {
        $data = array_merge(['success' => false], $data);
        return response()->json($data, $code);
    }
}
