<?php

namespace App\Http\Controllers;

use App\Services\AdviceServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdviceController extends Controller
{
    public function advice(AdviceServiceInterface $service)
    {
        $advice = $service->getAndSaveAdvice();
        return response()->json(['advice' => $advice->content], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
