<?php
namespace App\Traits;

trait ApiResponse
{
    public function successResponse($message='success', $data = null, $status = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public function errorResponse($message = 'error' , $data = null, $status = 400)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]);
    }
}