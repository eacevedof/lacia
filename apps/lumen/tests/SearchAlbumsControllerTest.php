<?php

namespace Tests;

final class SearchAlbumsControllerTest extends TestCase
{
    public function test_no_query_param_with_band_name_in_albums_endpoint()
    {
        $this->get("/api/v1/albums");
        $this->assertEquals(400, $this->response->getStatusCode());
    }

    public function test_response_search_method()
    {
        $md5 = md5("some weird band in request ".date("Y-m-d"));
        $this->get("/api/v1/albums?q=$md5");
        $this->assertEquals(404, $this->response->getStatusCode());
    }

}
