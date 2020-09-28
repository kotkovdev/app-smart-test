<?php
declare(strict_types=1);

namespace Tests\Feature\api\search;

use Tests\TestCase;

class SearchController extends TestCase
{
    public function testSearchSucceeds(): void
    {
        $response = $this->get('/api/search/?query=test');

        $response->assertStatus(200);
    }
}
