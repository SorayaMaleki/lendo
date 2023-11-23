<?php

namespace App\Traits\Response;

use Illuminate\Http\JsonResponse;
use function response;

trait ApiResponse
{
    /**
     * for return success Response
     * @param array $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function successResponse($data = [], $message = "", $code = 200): JsonResponse
    {
        return response()->json([
            "status" => true,
            "status_code"=>$code,
            "message"=>$message,
            "body"=>$data,
        ],$code);
    }

    /**
     * for return error Response
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function errorResponse($message = "", $code = 500): JsonResponse
    {
        return response()->json([
            "status" => false,
            "status_code"=>$code,
            "message"=>$message,
            "body"=>null,

        ],$code);
    }
}
