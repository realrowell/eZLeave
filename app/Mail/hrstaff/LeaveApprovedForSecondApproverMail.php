<?php

namespace App\Mail\hrstaff;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeaveApprovedForSecondApproverMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $leaveapplication;
    public $employee_name;
    public $leave_type;
    public $approved_by_name;
    public $reason;
    /**
     * Create a new message instance.
     */
    public function __construct($leaveapplication, $leave_approvals)
    {
        $this->leave_type = $leaveapplication->leavetypes->leave_type_title;
        $this->employee_name = $leaveapplication->employees->users->last_name.", ".$leaveapplication->employees->users->first_name;
        $this->leaveapplication = $leaveapplication;
        $this->approved_by_name = "Hr Staff (".$leave_approvals->users->email.")";
        $this->reason = $leave_approvals->reason_note;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Leave Application has been Approved!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.hrstaff.leave_approved_forSecondApprover',
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
