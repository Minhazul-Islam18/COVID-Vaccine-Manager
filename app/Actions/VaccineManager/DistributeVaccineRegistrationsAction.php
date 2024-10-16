<?php

namespace App\Actions\VaccineManager;

use App\Enums\VaccineRegistrationStatus;
use App\Models\VaccineCenter;
use App\Models\VaccineRegistration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DistributeVaccineRegistrationsAction
{
    /**
     * Distribute vaccine registrations to the respective centers based on availability.
     */
    public function execute()
    {
        VaccineRegistration::whereNull('vaccination_date')
            ->whereStatus(VaccineRegistrationStatus::NOT_SCHEDULED->value)
            ->whereNotNull('vaccine_center_id')
            ->orderBy('created_at', 'asc')
            ->with(['vaccineCenter'])
            ->chunk(100, function ($registrations) {
                $distribution = [];

                foreach ($registrations as $registration) {
                    $center = $registration->vaccineCenter;
                    if (!$center) {
                        Log::warning("Vaccine center not found for registration ID: " . $registration->id);
                        continue;
                    }

                    $date = Carbon::now();

                    // Checking next available date for the vaccine center
                    $nextAvailableDate = $this->getNextAvailableDate($date, $center, $distribution);

                    $registration->update([
                        'vaccination_date' => $nextAvailableDate,
                        'status' => VaccineRegistrationStatus::SCHEDULED->value,
                    ]);

                    $distribution[$nextAvailableDate] = ($distribution[$nextAvailableDate] ?? 0) + 1;
                }
            });

        Log::info('Vaccination scheduling completed.');
    }

    /**
     * Get the next available date for a given center, respecting daily limits.
     */
    private function getNextAvailableDate(Carbon $currentDate, VaccineCenter $center, array &$distribution): string
    {
        $weekdays = $center->getAvailableWeekdays();

        while (true) {
            $dayName = $currentDate->format('l');

            if (in_array($dayName, $weekdays)) {
                if (($distribution[$currentDate->toDateString()] ?? 0) < $center->daily_limit) {
                    return $currentDate->toDateString();
                }
            }

            $currentDate->addDay();
            if (!in_array($currentDate->format('l'), $weekdays)) {
                $currentDate->next($weekdays[0]);
            }
        }
    }
}
