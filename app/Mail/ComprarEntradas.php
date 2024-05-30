<?php

namespace App\Mail;

use App\Models\Evento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ComprarEntradas extends Mailable
{
    use Queueable, SerializesModels;

    public $evento;
    public $numEntradas;
    public $pdfPath; // Ruta del archivo PDF

    /**
     * Create a new message instance.
     *
     * @param Evento $evento
     * @param int $numEntradas
     * @param string $pdfPath Ruta al archivo PDF
     */
    public function __construct(Evento $evento, $numEntradas, $pdfPath)
    {
        $this->evento = $evento;
        $this->numEntradas = $numEntradas;
        $this->pdfPath = $pdfPath; // Asumiendo que el PDF ya está generado y almacenado
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.entradas.comprar')
            ->subject('Confirmación de Compra de Entradas')
            ->attach($this->pdfPath, [
                'as' => 'EntradaEvento.pdf',
                'mime' => 'application/pdf',
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Comprar Entradas',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.entradas.comprar',
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
