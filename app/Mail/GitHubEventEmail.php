<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GitHubEventEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $fromName       = 'ElliotDerhay.com';
    private $fromAddress    = 'web@elliotderhay.com';

    public $subject        = 'New GitHub Activity Event Type';

    public $types;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $eventTypes)
    {
        if( !(count($eventTypes) >= 1) ) {
            return abort(500);
        }

        $this->types = $eventTypes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.github.new-event-type')
                    ->from($this->fromAddress, $this->fromName)
                    ->replyTo($this->fromAddress, $this->fromName)
                    ->subject($this->subject);
    }
}
