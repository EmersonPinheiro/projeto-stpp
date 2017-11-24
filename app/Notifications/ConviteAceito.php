<?php

namespace App\Notifications;

use App\Obra;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ConviteAceito extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($convite)
    {
        $this->convite = $convite;
        $this->obra = Obra::where('Proposta_cod_proposta', '=', $this->convite->Proposta_cod_proposta)->first();
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
        $url = url('/admin/painel-administrador/'.$this->convite->Proposta_cod_proposta);
        return (new MailMessage)
                    ->line($this->convite->nome.' '.$this->convite->sobrenome.' aceitou ser avaliador(a) da obra "'.$this->obra->titulo.'"')
                    ->greeting('Olá')
                    ->action('Acessar proposta', $url)
                    ->line('Aguarde até que o(a) avaliador(a) envie um parecer.');
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
            'message_user'=>$this->convite->nome.' '.$this->convite->sobrenome.' aceitou ser avaliador(a) da obra "'.$this->obra->titulo.'"',
            'message_report'=>$this->convite->nome.' '.$this->convite->sobrenome.' aceitou ser avaliador(a)',
            'cod_proposta'=>$this->convite->Proposta_cod_proposta,
        ];
    }
}
