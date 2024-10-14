<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineCenter extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'daily_limit'];

    protected $table = 'vaccine_centers';

    // WEEKDAYS FOR VACCINE CENTERS
    public function getAvailableWeekdays(): array
    {
        return [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
        ];
    }
}
