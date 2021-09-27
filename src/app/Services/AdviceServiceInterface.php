<?php


namespace App\Services;


use App\Models\Advice;

interface AdviceServiceInterface
{
    public function getAdviceFromSite(): string;

    public function getAndSaveAdvice(): Advice;
}
