<?php

namespace Tests\Feature;

use App\Models\Advice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use LentochkaDocker\Testing\SafeTransactions;
use Tests\TestCase;

class AdviceModelTest extends TestCase
{
    use SafeTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAdviceSave()
    {
        $advice = Advice::factory()->create();

        $this->assertDatabaseHas('advice', ['content'=>$advice->content]);

    }
}
