<?php

namespace Tests\Feature;

use App\Models\Advice;
use App\Services\AdviceService;
use App\Services\AdviceServiceInterface;
use LentochkaDocker\Testing\SafeTransactions;
use Mockery\MockInterface;
use Tests\TestCase;

class AdviceControllerTest extends TestCase
{
    use SafeTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAdvice()
    {
        $advice = Advice::factory()->make();
        /** @var AdviceServiceInterface $service */ //мокаем один метод сервиса
        $service = $this->partialMock(AdviceService::class, function (MockInterface $mock) use ($advice) {
            $mock->shouldReceive('getAdviceFromSite')->once()->andReturn($advice->content);
        });

        app()->bind(AdviceServiceInterface::class, function() use ($service) {
            return $service;
        });
        $response = $this->get('/');
        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        self::assertSame($advice->content, $content['advice']);
    }
}
