<?php

namespace App\Http\Controllers\VaccineManager\Api;

use App\Enums\VaccineRegistrationStatus;
use Illuminate\Http\Request;
use App\Models\VaccineRegistration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class FrontendApiController extends Controller
{
    public function getStatus(Request $request)
    {
        $nid = $request->input('nid');

        $cacheKey = "vaccine_status_{$nid}";
        $registration = Cache::remember($cacheKey, 60 * 60, function () use ($nid) {
            return VaccineRegistration::where('nid', $nid)
                ->with('vaccineCenter:id,name')
                ->first();
        });

        if (!$registration) {
            return response()->json(['status' => VaccineRegistrationStatus::NOT_REGISTERED->value]);
        }

        $today = now()->format('Y-m-d');
        if ($registration->vaccination_date) {
            if ($registration->vaccination_date > $today) {
                return response()->json(['status' => VaccineRegistrationStatus::SCHEDULED->value, 'scheduled_date' => $registration->vaccination_date, 'vaccineCenter' => $registration->vaccineCenter?->name]);
            } elseif ($registration->vaccination_date < $today) {
                return response()->json(['status' => VaccineRegistrationStatus::VACCINATED->value]);
            }
        }

        return response()->json(['status' => VaccineRegistrationStatus::NOT_SCHEDULED->value]);
    }
}
