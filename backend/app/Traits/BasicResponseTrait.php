<?php

namespace App\Traits;

trait BasicResponseTrait {

    public function successResponse($data, $message = "Success")
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public function errorResponse($data, $message = "Error")
    {
        return response()->json([
            'status' => 409,
            'message' => $message,
            'data' => $data,
        ]);
    }
}
