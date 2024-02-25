<?php

namespace App\Http\Controllers\Nyt;

use App\Http\Requests\BestSellerRequest;
use App\Services\NytApi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class BestSellerController
{
    public function __construct(private NytApi $nytApi)
    {

    }

    /**
     * API for best seller books from NYT API
     *
     * @param BestSellerRequest $request
     * @return JsonResponse
     */
    public function index(BestSellerRequest $request): JsonResponse
    {
        try {
            $data = $this->nytApi->getBestSellerBooks($request);
            $results = $data['result'] ?? [];
            return response()->json($results);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Error',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}