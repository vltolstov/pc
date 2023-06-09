<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class RequestShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;
    public $clientEmail;
    public $clientPhone;
    public $clientMessage;
    public $productName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($clientName, $clientEmail, $clientPhone, $clientMessage, $productName)
    {

        $this->clientName = $clientName;
        $this->clientEmail = $clientEmail;
        $this->clientPhone = $clientPhone;
        $this->clientMessage = $clientMessage;
        $this->productName = $productName;

    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
        from: new Address('noreply@sumkiplus.ru', 'СумкиПлюс'),
        replyTo: [
            new Address($this->clientEmail, $this->productName),
        ],
        subject: 'Запрос с сайта СумкиПлюс'
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.request-template',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
