<?php

namespace App\Traits;

trait ApiResponse
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $statusCode)
    {
        $response = [
            'status_code' => $statusCode,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, $statusCode);
    }

    /**
     *For api pagination
     */
    public function paginationFormate($resource)
    {
        return [
            'total' => $resource->total(),
            'count' => $resource->count(),
            'per_page' => $resource->perPage(),
            'current_page' => $resource->currentPage(),
            'total_pages' => $resource->lastPage()
        ];
    }
}
