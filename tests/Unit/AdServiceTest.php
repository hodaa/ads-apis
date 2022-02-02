<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Tag;
use App\Services\AdService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use App\Models\Ad;

class AdServiceTest extends TestCase
{
    use RefreshDatabase;

    private AdService $adService;

    public function setUp() :void
    {
        parent::setUp();

        $this->adService = new AdService();

    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_service_return_data()
    {
        Ad::factory(1)->create([
            'start_date'=> Carbon::tomorrow()->toDateString()
        ]);
        $data = $this->adService->getAdsForTomorrow();
        $this->assertCount(1, $data);
    }

    /**
     * @return void
     */
    public function test_service_empty_data()
    {
        $data = $this->adService->getAdsForTomorrow();
        $this->assertEmpty($data);
    }
}
