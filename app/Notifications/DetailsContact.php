<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class DetailsContact extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject(__('Contact') . ' - ' . $this->data->subject)
            ->line('')
            ->line('Message for Contact form palmeravacations')
            ->line('')
            ->line('NAME: <strong>' . $this->data->name . '</strong>')
            ->line('EMAIL: <strong>' . $this->data->mail . '</strong>')
            ->line('CATEGORY: <strong>' . $this->data->category . '</strong>')
            ->line('MESSAGE:' . $this->data->message)
            ->line('')
            ->line('------------------------------------------------')
            ->line('')
            ->line('Mensaje de Contacto desde palmeravacations')
            ->line('')
            ->line('NOMBRE: <strong>' . $this->data->name . '</strong>')
            ->line('EMAIL: <strong>' . $this->data->mail . '</strong>')
            ->line('CATEGORÍA: <strong>' . $this->data->category . '</strong>')
            ->line('MENSAJE:' . $this->data->message);
    }


    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }
}
