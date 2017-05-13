<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $invoice;
    public $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $invoice, $type)
    {
        $this->user = $user;
        $this->invoice = $invoice;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->type == 'new') {
            return $this->view('mail.first-invoice');
        } else {
            return $this->view('mail.invoice');
        }
    }
}
