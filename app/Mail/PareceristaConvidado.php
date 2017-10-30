<?php

namespace App\Mail;

use App\ConviteParecerista;
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
    public function __construct(ConviteParecerista $convite)
    {
        $this->convite = $convite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("exemploadmin@email.com")
                    ->subject('Convite de avaliador!')
                    ->view('emails.pareceristas.convidado')
                    ->with(['convite'=>$this->convite]);
    }
}
