<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\PropertyManagementTransaction;

class DetailsTransaction extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(PropertyManagementTransaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $greeting = sprintf('Hello %s!', $notifiable->profile->full_namee);
        $period = $this->transaction->period_start_date . ' - ' . $this->transaction->period_end_date;

        return (new MailMessage)
            ->subject(__('Detail of Transaction') . $this->transaction->id)
            ->greeting($greeting)
            ->line('This are the details for transaction')
            ->line(__('Amount') . $this->transaction->amount)
            ->line(__('Period') . $period)
            ->line(__('Type') . $this->transaction->type->translate()->name)
            ->line(__('Post Date') . $this->transaction->post_date)
            ->line('Thank you for using our application!');
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
            //
        ];
    }
}
