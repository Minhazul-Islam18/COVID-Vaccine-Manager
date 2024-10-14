<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

class FrontendController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Frontend/Index');
    }

    public function vaccineData(): Response
    {
        return Inertia::render('Frontend/VaccineData');
    }

    public function getStatus(): JsonResponse
    {
        return response()->json();
    }
}
