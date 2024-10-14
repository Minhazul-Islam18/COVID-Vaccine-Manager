<?php

namespace App\Mail\VaccineManager;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\VaccineRegistration;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class VaccinationNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public VaccineRegistration $registration) {}


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vaccination Appointment Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.vaccination_notification',
            with: [
                'userName' => $this->registration->name,
                'vaccinationDate' => $this->registration->vaccination_date,
                'vaccineCenterName' => $this->registration->vaccineCenter->name,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
