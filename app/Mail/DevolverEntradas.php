<?php

namespace App\Mail;

use App\Models\Evento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DevolverEntradas extends Mailable
{
    use Queueable, SerializesModels;

    public $evento;
    public $numEntradas;

    /**
     * Create a new message instance.
     *
     * @param Evento $evento
     * @param int $numEntradas
     */
    public function __construct(Evento $evento, $numEntradas)
    {
        $this->evento = $evento;
        $this->numEntradas = $numEntradas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.entradas.devolver')
            ->subject('Devolución de Entradas - ' . $this->evento->titulo)
            ->with([
                'titulo' => $this->evento->titulo,
                'fecha' => $this->evento->fecha,
                'hora' => $this->evento->hora,
                'lugar' => $this->evento->sede->nombre,
                'numEntradas' => $this->numEntradas
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Devolver Entradas',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.entradas.devolver',
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
