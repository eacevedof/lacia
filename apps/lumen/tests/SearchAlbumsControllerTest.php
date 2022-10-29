<?php

namespace Tests;

final class SearchAlbumsControllerTest extends TestCase
{
    public function test_albums_endpoint()
    {
        $this->get("/api/v1/albums");
        $this->assertEquals(200, $this->response->getStatusCode());
    }

    public function test_response_search_method()
    {
        $this->get("/api/v1/albums");
        $this->assertEquals(200, $this->response->getStatusCode());
    }

}
