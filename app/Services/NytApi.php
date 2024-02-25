<?php

namespace App\Services;

use App\Http\Requests\BestSellerRequest;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class NytApi
{
    /**
     * @var PendingRequest $client
     */
    private PendingRequest $client;

    /**
     * Setting up http client for NYT API
     */
    public function __construct()
    {
        $this->client = Http::withUrlParameters([
            'endpoint' => config('services.nyt.endpoint'),
            'version' => config('services.nyt.version'),
        ]);
    }

    /**
     * Getting the bestseller books on NYT API
     *
     * @param BestSellerRequest $request
     * @return array
     */
    public function getBestSellerBooks(BestSellerRequest $request): array
    {
        $params = ['api-key' => config('services.nyt.key')];
        if ($request->has('title')) {
            $params['title'] = $request->title;
        }
        if ($request->has('isbn')) {
            $params['isbn'] = implode(';', $request->isbn);
        }
        if ($request->has('author')) {
            $params['author'] = $request->author;
        }
        if ($request->has('offset')) {
            $params['offset'] = $request->offset;
        }

        $results = $this->client->get(
            '{+endpoint}/books/{version}/lists/best-sellers/history.json',
            $params
        );

        return [
            'status' => $results->status(),
            'result' => $results->collect(),
        ];
    }
}