<?php

namespace App\Mail\Admin;

use App\Models\Suffix;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetMailNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user_fullname;
    public $user_name;
    public $user_email;
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        if(filled($data['suffix_id'])){
            $user_suffix = Suffix::where('id', $data['suffix_id'])->first();
            $user_suffix = $user_suffix->suffix_title;
        }
        else{
            $user_suffix = ' ';
        }
        $this->user_fullname = $data['first_name'].' '.$data['middle_name'].' '.$data['last_name'].' '.$user_suffix;
        $this->user_name = $data['user_name'];
        $this->user_email = $data['email'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Password has been Reset!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.admin.password_reset_notification',
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
