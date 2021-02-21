<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;

trait ResponsesTrait
{

    public function successApiResponse(Arrayable|array $data = [], $message = '', $httpCode = 200): JsonResponse
    {
        if (!is_array($data)) {
            $data = $data->toArray();
        }
        if (!empty($message)) {
            $data['message'] = $message;
        }
        return response()->json($data, $httpCode);
    }

    public function failApiResponse(Arrayable|array $data = [], $message = '', $httpCode = 400): JsonResponse
    {
        if (!is_array($data)) {
            $data = $data->toArray();
        }
        if (!empty($message)) {
            $data['message'] = $message;
        }
        return response()->json($data, $httpCode);
    }

}