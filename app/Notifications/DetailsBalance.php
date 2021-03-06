<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class DetailsBalance extends Notification
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
            ->subject('Balance' . ' - ' . $this->data->property)
            ->line(new HtmlString('<br>'))
            ->line('Here are the details of your current balance')
            ->line(new HtmlString('<br>'))
            ->line('Date' . ': ' . getCurrentDateTime())
            ->line(new HtmlString('Property' . ': ' . '<strong>' . $this->data->property . '</strong>'))
            ->line(new HtmlString('Balance' . ': ' . '<strong>' . priceFormat($this->data->balance) . ' MXN</strong>'))
            ->line(new HtmlString('Extra notes: ' . nl2br($this->data->customMsg)))
            ->line(new HtmlString('<br>'))
            ->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'))
            ->line(new HtmlString('<br>'))
            ->line('Aquí están los detalles de su balance actual')
            ->line(new HtmlString('<br>'))
            ->line('Fecha' . ': ' . getCurrentDateTime())
            ->line(new HtmlString('Propiedad' . ': ' . '<strong>' . $this->data->property . '</strong>'))
            ->line(new HtmlString('Balance' . ': ' . '<strong>' . priceFormat($this->data->balance) . ' MXN</strong>'))
            ->line(new HtmlString('Notas adicionales: ' . nl2br($this->data->customMsg)))
            ->line('')
            ->line('');
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
