<?php

namespace App\Mail;

use App\Models\TheaterList;
use Barryvdh\DomPDF\PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InformUser extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $theater_name;


    public function __construct($ticket)
    {
        $this->ticket = $ticket;
        $this->theater_name = TheaterList::where('id', $ticket->theater_id)->pluck('name')->first();
    }

    public function build()
    {
        $pdf = app(PDF::class)->loadView('pdf', ['ticket' => $this->ticket,'theater_name' => $this->theater_name]);

        return $this->view('user_mail')
            ->subject('Ticket booked successfully')
            ->attachData($pdf->output(), 'ticket_details.pdf');
    }



    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'user_mail',
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
