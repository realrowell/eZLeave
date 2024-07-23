<?php

namespace App\Mail\employee;

use App\Models\LeaveApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeaveAppFullyApproved extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $leaveapplication;
    public $leave_type;
    public $approved_by_name;
    public $reason;
    public $status;
    /**
     * Create a new message instance.
     */
    public function __construct($leave_applications, $leave_approvals )
    {
        $leave_application = LeaveApplication::where('reference_number',$leave_applications['reference_number'])->first();

        $this->leave_type = $leave_applications->leavetypes->leave_type_title;
        $this->leaveapplication = $leave_applications;
        $this->approved_by_name = $leave_approvals->users->first_name.' '.$leave_approvals->users->last_name;
        $this->reason = $leave_approvals->reason_note;
        $this->status = $leave_application->statuses->status_title;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Leave Application has been Fully Approved',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.employee.leave_app_fullApproved',
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
