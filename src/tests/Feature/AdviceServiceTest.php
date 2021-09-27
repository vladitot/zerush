<?php

namespace Tests\Feature;

use App\Models\Advice;
use App\Services\AdviceService;
use App\Services\AdviceServiceInterface;
use Illuminate\Support\Facades\Http;
use LentochkaDocker\Testing\SafeTransactions;
use Mockery\MockInterface;
use Tests\TestCase;

class AdviceServiceTest extends TestCase
{
    use SafeTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetAdviceFromSiteREAL()
    {
        $adviceSynth = Advice::factory()->make(); //не CREATE а MAKE, чтоб не сохранять в базу сразу
        $fakeResponse = json_decode(
            '{"id":'.mt_rand(1, 9898989898).',"text":"'.$adviceSynth->content.'","sound":""}', true
        );
        /** @var \Illuminate\Http\Client\Factory $request */
        $request = app()->make(\Illuminate\Http\Client\Factory::class);
        $request->fake([
            'fucking-great-advice.ru/api/random' => Http::response($fakeResponse, 200, []),
        ]);

        /** @var AdviceServiceInterface $service */
        $service = app()->make(AdviceServiceInterface::class, ['request'=>$request]);
        $advice = $service->getAdviceFromSite();
        self::assertSame($adviceSynth->content, $advice);
    }

    public function testGetAndSaveAdvice() {
        $advice = Advice::factory()->make(); //не сохраняем в БД.

        /** @var AdviceServiceInterface $service */ //мокаем один метод сервиса
        $service = $this->partialMock(AdviceService::class, function (MockInterface $mock) use ($advice) {
            $mock->shouldReceive('getAdviceFromSite')->once()->andReturn($advice->content);
        });

        $resultAdvice = $service->getAndSaveAdvice();
        self::assertSame($advice->content, $resultAdvice->content);
        $this->assertDatabaseHas('advice', ['content'=>$advice->content]);
    }
}
