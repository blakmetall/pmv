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
        $subject = __('Contact') . ' - ' . $this->data->subject;

        $mailMsg = new MailMessage();
        $mailMsg->subject($subject);

        if(\App::getLocale() == 'en') {
            $mailMsg->line('Message from contact form from website');
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line('Name: ' . $this->data->name);
            $mailMsg->line('Email: ' . $this->data->mail);
            $mailMsg->line('Category: <strong>' . $this->data->category);
            $mailMsg->line('Message:' . $this->data->message);
        }else{
            $mailMsg->line('Mensaje del formulario de contacto del sitio web');
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line('Nombre: ' . $this->data->name);
            $mailMsg->line('Email: ' . $this->data->mail);
            $mailMsg->line('Categoría: ' . $this->data->category);
            $mailMsg->line('Mensaje:' . $this->data->message);
        }

        return $mailMsg;
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
