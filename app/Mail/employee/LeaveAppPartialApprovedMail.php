<?php

namespace App\Mail\employee;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeaveAppPartialApprovedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $leaveapplication;
    public $employee_name;
    public $leave_type;

    /**
     * Create a new message instance.
     */
    public function __construct($leaveapplication)
    {
        $this->leave_type = $leaveapplication->leavetypes->leave_type_title;
        $this->employee_name = $leaveapplication->employees->users->last_name.", ".$leaveapplication->employees->users->first_name;
        $this->leaveapplication = $leaveapplication;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Leave Application has Partially Approved',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.employee.leave_app_forApprover',
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
