<?php

namespace App\Services;


use App\Models\Advice;

class AdviceService implements AdviceServiceInterface
{

    /**
     * @var \Illuminate\Http\Client\Factory
     */
    private $request;

    public function __construct(\Illuminate\Http\Client\Factory $request)
    {
        $this->request = $request;
    }

    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getAdviceFromSite(): string
    {
        $result = $this->request->get('http://fucking-great-advice.ru/api/random');
        $result->throw();
        $data = json_decode($result->body(), true);
        return $data['text'];
    }

    public function getAndSaveAdvice(): Advice {
        $adviceContent = $this->getAdviceFromSite();
        $advice = new Advice();
        $advice->content = $adviceContent;
        $advice->save();
        return $advice;
    }
}
