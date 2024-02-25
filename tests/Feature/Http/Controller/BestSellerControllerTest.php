<?php

namespace Tests\Feature\Http\Controller;

use App\Services\NytApi;
use Illuminate\Http\Response;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class BestSellerControllerTest extends TestCase
{
    /**
     * Test index endpoint on BestSeller API
     *
     * @dataProvider bestSellerBooksDataProvider
     */
    public function testIndex($testParams, $testResponse): void
    {
        $this->instance(
            NytApi::class,
            Mockery::mock(NytApi::class, function (MockInterface $mock) use ($testResponse) {
                $mock->shouldReceive('getBestSellerBooks')
                    ->andReturn($testResponse);
            })
        );
        $response = $this->get(route('api.v1.nyt.best-sellers.index', $testParams));
        $dataset = $response->collect()->toArray();

        $this->assertEquals($dataset, $testResponse['result']);
    }

    /**
     * data provider for index function
     */
    public static function bestSellerBooksDataProvider(): array
    {
        return [
            [
                [
                    'title' => 'Test Title 1',
                ],
                [
                    'status' => Response::HTTP_OK,
                    'result' => [
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
                        ]
                    ],
                ],
            ],
            [
                [
                    'isbn' => [
                        1234567890,
                        1234123412346,
                    ]
                ],
                [
                    'status' => Response::HTTP_OK,
                    'result' => [
                        "status" => "OK",
                        "copyright" => "Copyright (c) 2024 The New York Times Company. All Rights Reserved.",
                        "num_results" => 2,
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
                            ],
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
                                        "isbn10" => "1234567891",
                                        "isbn13" => "1234123412346"
                                    ]
                                ],
                                "ranks_history" => [
                                    [
                                        "primary_isbn10" => "1234567891",
                                        "primary_isbn13" => "1234123412346",
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
                    ],
                ],
            ],
        ];
    }
}