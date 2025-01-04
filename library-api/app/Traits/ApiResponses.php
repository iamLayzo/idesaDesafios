<?php

namespace App\Traits;

trait ApiResponses
{
    public function notFoundResponse($message)
    {
        return response()->json(['error' => $message], 404);
    }

    public function successResponse($message, $data = [], $statusCode = 200)
    {
        return response()->json(['message' => $message, 'data' => $data], $statusCode);
    }
}
