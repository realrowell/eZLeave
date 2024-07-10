<?php

namespace App\Mail\employee;

use App\Models\LeaveApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeaveRejectForEmployeeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $leaveapplication;
    public $leave_type;
    public $status;
    public $approved_by_name;
    public $reason;
    /**
     * Create a new message instance.
     */
    public function __construct($leave_applications, $leave_approvals)
    {
        $leave_application = LeaveApplication::where('reference_number',$leave_applications['reference_number'])->first();
        $this->leave_type = $leave_applications->leavetypes->leave_type_title;
        $this->leaveapplication = $leave_applications;
        $this->status = $leave_application->statuses->status_title;
        $this->approved_by_name = $leave_approvals->users->first_name.' '.$leave_approvals->users->last_name;
        $this->reason = $leave_approvals->reason_note;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Leave Application has been Rejected',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.employee.leave_app_rejected',
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
