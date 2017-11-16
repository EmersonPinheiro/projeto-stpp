<?php

namespace App\Notifications;

use App\Obra;
use App\Pessoa;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProrrogacaoSolicitada extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($parecer)
    {
        $this->parecer = $parecer;
        $this->obra = Obra::where('Proposta_cod_proposta', '=', $this->parecer->Proposta_cod_proposta)->first();
        $this->parecerista = Pessoa::join('Usuario', 'Usuario.Pessoa_cod_pessoa', '=', 'Pessoa.cod_pessoa')
                                  ->join('Usuario_Parecerista', 'Usuario_Parecerista.Usuario_cod_usuario', '=', 'Usuario.cod_usuario')
                                  ->where('Usuario_Parecerista.cod_parecerista', '=', $this->parecer->Usuario_Parecerista_cod_parecerista)
                                  ->select('Pessoa.*')
                                  ->first();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/admin/painel-administrador/'.$this->parecer->Proposta_cod_proposta);
        return (new MailMessage)
                    ->subject('Solicitação de prorrogação de prazo')
                    ->line('O(a) parecerista '.$this->parecerista->nome.' '.$this->parecerista->sobrenome .' da obra "'.$this->obra->titulo.'" solicitou prorrogação do prazo de envio do parecer.')
                    ->action('Prorrogar prazo', $url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message_user'=>'O parecerista '.$this->parecerista->nome.' '.$this->parecerista->sobrenome .' da obra "'.$this->obra->titulo.'" solicitou prorrogação do prazo de envio do parecer.',
            'message_report'=>'O parecerista '.$this->parecerista->nome.' '.$this->parecerista->sobrenome .' solicitou prorrogação do prazo de envio do parecer.',
            'cod_proposta'=>$this->parecer->Proposta_cod_proposta,
            'cod_parecer'=>$this->parecer->cod_parecer,
        ];
    }
}
