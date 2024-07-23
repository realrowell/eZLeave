<?php

namespace App\Mail\employee;

use App\Models\LeaveApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeaveAppForSecondApprover extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $leaveapplication;
    public $employee_name;
    public $leave_type;
    public $status;
    /**
     * Create a new message instance.
     */
    public function __construct($leave_applications)
    {
        $leave_application = LeaveApplication::where('reference_number',$leave_applications['reference_number'])->first();
        $this->leave_type = $leave_applications->leavetypes->leave_type_title;
        $this->employee_name = $leave_applications->employees->users->first_name." ".$leave_applications->employees->users->last_name;
        $this->leaveapplication = $leave_applications;
        $this->status = $leave_application->statuses->status_title;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Leave App For Second Approver',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.employee.leave_app_forSecondApprover',
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
