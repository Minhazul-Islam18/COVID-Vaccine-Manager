<?php

namespace App\Events\VaccineManager;

use App\Models\VaccineRegistration;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VaccineRegistrationCompletedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public VaccineRegistration $registration;

    /**
     * Create a new event instance.
     */
    public function __construct(VaccineRegistration $registration)
    {
        $this->registration = $registration;
    }
}
