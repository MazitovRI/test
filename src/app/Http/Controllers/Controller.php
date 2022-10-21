<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

/**
 * parent controller
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * response
     * 
     * @param data
     * @param status
     * @param message
     * @param headers
     * @return JsonResponse
     */
    protected function response($data, int $status=200, string $message='', array $headers = []): JsonResponse
    {
        $response = [
            'data' => $data
        ];

        if (!empty($message)) {
            $response['message'] = $message;
        }

        return response()->json($response, $status, $headers);
    }
}