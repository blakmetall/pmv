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
            ->greeting(sprintf('Hello %s!', $notifiable->profile->full_name))
            ->line('Here are the details of your current balance')
            ->line('Date' . ': ' . getCurrentDateTime())
            ->line(new HtmlString('Property' . ': ' . '<strong>' . $this->data->property . '</strong>'))
            ->line(new HtmlString('Balance' . ': ' . '<strong>' . priceFormat($this->data->balance) . '</strong>'))
            ->line('------------------------------------------------')
            ->greeting(sprintf('Hola %s!', $notifiable->profile->full_name))
            ->line('Aquí están los detalles de su balance actual')
            ->line('Fecha' . ': ' . getCurrentDateTime())
            ->line(new HtmlString('Propiedad' . ': ' . '<strong>' . $this->data->property . '</strong>'))
            ->line(new HtmlString('Balance' . ': ' . '<strong>' . priceFormat($this->data->balance) . '</strong>'));
        // ->line(__('Pending Audit').': '.$this->data->pendingAudit)
        // ->line(__('Estimated Balance').': '.priceFormat($this->data->estimatedBalance));
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
