<?php

namespace App\Mail;

use App\ConviteParecerista;
use App\Obra;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PareceristaConvidado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ConviteParecerista $convite, Obra $obra)
    {
        $this->convite = $convite;
        $this->obra = $obra;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //TODO: Colcoar e-mail do admin.
        return $this->from("exemploadmin@email.com")
                    ->subject('Convite de avaliador!')
                    ->view('emails.pareceristas.convidado')
                    ->with(['convite'=>$this->convite, 'obra'=>$this->obra]);
    }
}
