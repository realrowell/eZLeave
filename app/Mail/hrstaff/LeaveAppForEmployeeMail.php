<?php

namespace App\Mail\hrstaff;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeaveAppForEmployeeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $leaveapplication;
    public $employee_name;
    public $leave_type;
    public $approver_name;
    public $second_approver_name;
    /**
     * Create a new message instance.
     */
    public function __construct($leaveapplication)
    {
        $this->leave_type = $leaveapplication->leavetypes->leave_type_title;
        $this->approver_name = $leaveapplication->approvers->users->last_name.", ".$leaveapplication->approvers->users->first_name;
        $this->leaveapplication = $leaveapplication;
        if($leaveapplication->second_approver_id != null){
            $this->second_approver_name = $leaveapplication->second_approvers->users->last_name.", ".$leaveapplication->second_approvers->users->first_name;
        }
        else{
            $this->second_approver_name = "N/A";
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Leave Application has been filed',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.hrstaff.leave_app_forEmployee',
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
