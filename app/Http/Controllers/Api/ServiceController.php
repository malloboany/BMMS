<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MyResult;
use App\Models\ServiceType;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function index(): JsonResponse
    {
        $services = ServiceType::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return MyResult::success($services);
    }
}
