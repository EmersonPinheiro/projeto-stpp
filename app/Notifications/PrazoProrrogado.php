<?php

namespace App\Notifications;

use App\Obra;
use App\Pessoa;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PrazoProrrogado extends Notification
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
        $url = url('/enviar-parecer/'.$this->parecer->cod_parecer);
        return (new MailMessage)
                    ->subject('Prazo prorrogado!')
                    ->greeting('Olá!')
                    ->line('Seu prazo de avaliação da obra "'.$this->obra->titulo.'" foi prorrogado!')
                    ->line('Clique no botão abaixo para acessar a obra e enviar seu parecer. Fique atento(a) ao novo prazo.')
                    ->action('Acessar obra', $url);
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
            'message_user'=>'Prazo de envio do parecer da obra "'.$this->obra->titulo.'" foi prorrogado por mais 30 dias.',
            'message_report'=>'Prazo de envio do parecer de '. $this->parecerista->nome.' '. $this->parecerista->sobrenome.' prorrogado em 30 dias.',
            'cod_proposta'=>$this->parecer->Proposta_cod_proposta,
            'cod_parecer'=>$this->parecer->cod_parecer,
        ];
    }
}
