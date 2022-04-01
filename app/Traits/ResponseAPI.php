<?php

namespace App\Traits;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

Trait ResponseAPI
{
    /**core response
     * @param $message
     * @param $statusCode
     * @param bool $isSuccess
     * @param $data
     * @return JsonResponse
     */
    public function coreResponse($message, $data = null, $statusCode, bool $isSuccess = true): JsonResponse
    {

        //check paras
        if (!$message) {
            return response()->json(['message' => 'message is required'], 500);
        }

        if ($isSuccess) {
            return response()->json([
                'message' => $message,
                'error' => false,
                'code' => $statusCode,
                'data' => $data,
            ], $statusCode);

        }

        return response()->json([
            'message' => $message,
            'error' => true,
            'code' => $statusCode,

        ], $statusCode);

    }

    /**return success and data
     * @param $message
     * @param $data
     * @param int $statusCde
     * @return JsonResponse
     */
    public function success($message, $data, int $statusCde = 200): JsonResponse
    {
        return $this->coreResponse($message, $data, $statusCde );

    }

    /** return error
     * @param $message
     * @param $stateCode
     * @return JsonResponse
     */
    public function error($message, $stateCode): JsonResponse
    {

        return $this->coreResponse($message, null, $stateCode, false);
    }

}
