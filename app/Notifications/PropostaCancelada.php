<?php

namespace App\Notifications;

use App\Obra;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PropostaCancelada extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($proposta)
    {
        $this->proposta = $proposta;
        $this->obra = Obra::where('Proposta_cod_proposta', '=', $this->proposta->cod_proposta)->first();
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
        $url = url('/propostas/'.$this->proposta->cod_proposta);
        return (new MailMessage)
                    ->subject('Cancelamento de proposta.')
                    ->greeting('Olá!')
                    ->line('Sua proposta "'.$this->obra->titulo.'" foi cancelada.');
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
            'message_user'=>'A proposta "'.$this->obra->titulo.'" foi cancelada.',
            'message_report'=>'Proposta cancelada.',
            'cod_proposta'=>$this->proposta->cod_proposta
        ];
    }
}
