<?php

namespace App\Notifications;

use App\Obra;
use App\Pessoa;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ParecerEnviado extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($parecer, $observacoes)
    {
        $this->parecer = $parecer;
        $this->obra = Obra::where('Proposta_cod_proposta', '=', $this->parecer->Proposta_cod_proposta)->first();
        $this->parecerista = Pessoa::join('Usuario', 'Usuario.Pessoa_cod_pessoa', '=', 'Pessoa.cod_pessoa')
                                  ->join('Usuario_Parecerista', 'Usuario_Parecerista.Usuario_cod_usuario', '=', 'Usuario.cod_usuario')
                                  ->where('Usuario_Parecerista.cod_parecerista', '=', $this->parecer->Usuario_Parecerista_cod_parecerista)
                                  ->select('Pessoa.*')
                                  ->first();

        if ($observacoes != null) {
          $this->observacoes = $observacoes;
        }
        else {
          $this->observacoes = 'Não há.';
        }
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
        //TODO: Talvez substituir por um método de download do parecer.
        $url = url('/admin/painel-administrador/'.$this->parecer->Proposta_cod_proposta);

          return (new MailMessage)
                      ->subject('Perecer enviado!')
                      ->greeting('Olá!')
                      ->line($this->parecerista->nome.' '.$this->parecerista->sobrenome.' enviou um parecer para a obra "'.$this->obra->titulo.'".')
                      ->action('Acessar parecer', $url)
                      ->line('Observações: '.$this->observacoes);
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
            'message_user'=>$this->parecerista->nome.' '.$this->parecerista->sobrenome.' enviou um parecer para a obra "'.$this->obra->titulo.'".',
            'message_report'=>$this->parecerista->nome.' '.$this->parecerista->sobrenome.' enviou um parecer. Observacoes: '.$this->observacoes,
            'cod_proposta'=>$this->parecer->Proposta_cod_proposta,
        ];
    }
}
