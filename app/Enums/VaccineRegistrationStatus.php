<?php

namespace App\Enums;

enum VaccineRegistrationStatus: string
{
    case VACCINATED = 'vaccinated';
    case NOT_REGISTERED = 'not_registered';
    case NOT_SCHEDULED = 'not_scheduled';
    case SCHEDULED = 'SCHEDULED';

    /**
     * Convert enum cases to an array.
     *
     * @return array
     */
    public static function toArray(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
