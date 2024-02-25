<?php

namespace Tests\Unit\Services;

use App\Http\Requests\BestSellerRequest;
use App\Services\NytApi;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class NytApiTest extends TestCase
{
    /**
     * test bestSellerBooks on NytApi
     */
    public function testGetBestSellerBooks(): void
    {
        $testResponse = [
            "status" => "OK",
            "copyright" => "Copyright (c) 2024 The New York Times Company. All Rights Reserved.",
            "num_results" => 1,
            "results" => [
                [
                    "title" => 'Test Title 1',
                    "description" => "Test description 1",
                    "contributor" => "Test contributor 1",
                    "author" => "Test Author One",
                    "contributor_note" => "",
                    "price" => "0.00",
                    "age_group" => "",
                    "publisher" => "Test Publisher",
                    "isbns" => [
                        [
                            "isbn10" => "1234567890",
                            "isbn13" => "1234123412345"
                        ]
                    ],
                    "ranks_history" => [
                        [
                            "primary_isbn10" => "1234567890",
                            "primary_isbn13" => "1234123412345",
                            "rank" => 1,
                            "list_name" => "Advice How-To and Miscellaneous",
                            "display_name" => "Advice, How-To & Miscellaneous",
                            "published_date" => "2016-09-04",
                            "bestsellers_date" => "2016-08-20",
                            "weeks_on_list" => 1,
                            "rank_last_week" => 0,
                            "asterisk" => 0,
                            "dagger" => 0
                        ]
                    ],
                    "reviews" => [
                        [
                            "book_review_link" => "",
                            "first_chapter_link" => "",
                            "sunday_review_link" => "",
                            "article_chapter_link" => ""
                        ]
                    ]
                ]
            ],
        ];
        Http::fake([
            '*' => Http::response($testResponse, 200)
        ]);
        $result = (new NytApi())->getBestSellerBooks(new BestSellerRequest([
            'title' => 'Test Title 1',
        ]));


        $this->assertEquals([
            'status' => Response::HTTP_OK,
            'result' => collect($testResponse),
        ], $result);
    }
}