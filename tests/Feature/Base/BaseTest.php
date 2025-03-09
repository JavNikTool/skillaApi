<?php

namespace Tests\Feature\Base;

use App\Models\Partnership;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BaseTest extends TestCase
{
    use RefreshDatabase;
    protected const BASE_PATH = '/api/v1';

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'partnership_id' => Partnership::factory()->create()->id,
        ]);
        $this->actingAs($this->user, 'api');
    }
}
