<?php

namespace tests\Feature;

use Tests\TestCase;

class StatisticsTest extends TestCase
{
    public function test_list_statistics()
    {
        $response = $this->get('/api/statistics');

        $response->assertStatus(200);
    }
}
