<?php

namespace App\Traits;

use Ramsey\Collection\Collection;

trait ApiResponser
{
    protected function successResponse($data, $code)
    {
        $data = array_merge(['success' => true], $data);
        return response()->json($data, $code);
    }

    protected function successMessage($message, $code)
    {
        $data = ['success' => true, 'message' => $message];
        return response()->json($data, $code);
    }

    protected function errorMessage($message, $code)
    {
        $data = ['success' => false, 'message' => $message];
        return response()->json($data, $code);
    }

    protected function validationResponse($data, $code)
    {
        $data = array_merge(['success' => false], $data);
        return response()->json($data, $code);
    }
}
