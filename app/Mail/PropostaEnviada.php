<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PropostaEnviada extends Mailable
{
    use Queueable, SerializesModels;

    private $dados;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('exemploemail@exemplo.com')
                    ->subject('Nova proposta!')
                    ->view('emails.propostas.enviada')
                    ->with(['dados'=>$this->dados]);
    }
}
