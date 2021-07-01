<?php

namespace App\Notifications;

use App\Models\PropertyManagementTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

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
        $period = $this->transaction->period_start_date . ' - ' . $this->transaction->period_end_date;
        $operationType = $this->transaction->operation_type == config('constants.operation_types.charge') ? __('Charge') : __('Credit');

        return (new MailMessage())
            ->subject(__('Transaction') . ': ' . $this->transaction->id)
            ->line('')
            ->line(new HtmlString(__('Transaction ID') . ': ' . '<strong>' . $this->transaction->id . '</strong>'))
            ->line(new HtmlString(__('Property') . ': ' . '<strong>' . $this->transaction->propertyManagement->property->translate()->name . '</strong>'))
            ->line(new HtmlString(__('Post Date') . ': ' . '<strong>' . $this->transaction->post_date . '</strong>'))
            ->line(new HtmlString(__('Description') . ': <strong>' . $this->transaction->description . '</strong>'))
            ->line(new HtmlString(__('Period') . ': ' . '<strong>' . $period . '</strong>'))
            ->line(new HtmlString(__('Operation') . ': ' . '<strong>' . $this->transaction->type->translate()->name . '</strong>'))
            ->line(new HtmlString(__('Operation Type') . ': ' . '<strong>' . $operationType . '</strong>'))
            ->line(new HtmlString(__('Amount') . ': ' . '<strong>' . priceFormat($this->transaction->amount) . ' MXN</strong>'))
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
