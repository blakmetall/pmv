<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

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
        $greeting = sprintf('Hello %s!', $notifiable->profile->full_name);

        return (new MailMessage())
            ->subject(__('Balance').' - '.$this->data->property)
            ->greeting($greeting)
            ->line(__('Here are the details of your current balance'))
            ->line(__('Date').': '.getCurrentDateTime())
            ->line(__('Property').': '.$this->data->property)
            ->line(__('Balance').': '.priceFormat($this->data->balance))
            // ->line(__('Pending Audit').': '.$this->data->pendingAudit)
            ->line(__('Estimated Balance').': '.priceFormat($this->data->estimatedBalance));
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
        return [
        ];
    }
}
