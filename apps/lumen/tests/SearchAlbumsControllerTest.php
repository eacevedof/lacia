<?php

namespace Tests;

final class SearchAlbumsControllerTest extends TestCase
{
    private const NONEXISTENT_BAND_NAME = "This is A Weird Band Name";

    public function test_no_query_param_with_band_name_in_albums_endpoint()
    {
        $this->get("/api/v1/albums");
        $this->assertEquals(400, $this->response->getStatusCode());
    }

    public function test_response_search_method()
    {
        $md5 = md5(self::NONEXISTENT_BAND_NAME);
        $this->get("/api/v1/albums?q=$md5");
        $this->assertEquals(404, $this->response->getStatusCode());
    }

    public function test_response_of_a_good_query_search()
    {
        $this->get("/api/v1/albums?q=soda stereo");
        $this->assertEquals(200, $this->response->getStatusCode());
    }
}
