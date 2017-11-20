<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmacaoCadastro extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($confirmation_token)
    {
        $this->confirmation_token=$confirmation_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("editora@gmail.com")
                    ->subject("Confirmação de e-mail")
                    ->view('emails.confirmacao-cadastro')
                    ->with(['confirmation_token'=>$this->confirmation_token]);
    }
}
