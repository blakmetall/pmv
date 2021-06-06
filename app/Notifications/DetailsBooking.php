<?php

namespace App\Notifications;

use App\Models\PropertyBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class DetailsBooking extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(PropertyBooking $booking)
    {
        $this->booking = $booking;
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

        $property = $this->booking->property->translate();
        $propertyType = $this->booking->property->type->translate();
        $bedrooms = $this->booking->property->bedrooms;
        $baths = $this->booking->property->baths;
        $location = $this->booking->property->zone->translate();
        $address = $this->booking->property->address;
        $total    = $this->booking->total;
        $payments = $this->booking->payments;
        
        $reduced  = 0;
        
        foreach ($payments as $payment) {
            if($payment->is_paid){
                $reduced += $payment->amount;
            }
        }

        $balance = $total - $reduced;
        $damageDeposit = ($this->booking->subtotal_damage_deposit) ? $this->booking->subtotal_damage_deposit : 0;
    
        return (new MailMessage())
            ->subject(__('Booking Details').' #' . $this->booking->id)
            ->line('')
            ->line('This is a copy of a booking:')
            ->line(new HtmlString('CONFIRMATION: <strong>' . $this->booking->id . '</strong>'))
            ->line(new HtmlString('STATUS: <strong>' . getBookingStatus($this->booking, 'en') . '<strong>'))
            ->line(new HtmlString('BOOKING DATE: <strong>' . $this->booking->created_at . '</strong>'))
            ->line('------------------------------------------------')
            ->line('TRAVEL DETAILS')
            ->line('------------------------------------------------')
            ->line(new HtmlString('RESERVATION NAME: <strong>' . $this->booking->full_name . '</strong>'))
            ->line(new HtmlString('DATES: <strong>' . $this->booking->arrival_date . ' - ' . $this->booking->departure_date . '</strong>'))
            ->line(new HtmlString('RATE: <strong>Avg. Night ' . priceFormat($this->booking->price_per_night) . ' USD | Total stay ' . priceFormat($this->booking->subtotal_nights) . 'USD</strong>'))
            ->line('------------------------------------------------')
            ->line('PROPERTY DETAILS')
            ->line('------------------------------------------------')
            ->line(new HtmlString('PROPERTY: <strong>' . $property->name . '</strong> / <strong>' . $propertyType->name . '</strong> / <strong>' . $bedrooms . ' Bedrooms</strong> / <strong>' . $baths . ' Bathrooms</strong>'))
            ->line(new HtmlString('LOCATION: <strong>' . $location->name . '</strong>'))
            ->line(new HtmlString('ADDRESS: <strong>' . $address . '</strong>'))
            ->line('------------------------------------------------')
            ->line('SECURITY DEPOSIT / ACCIDENTAL DAMAGE INSURANCE')
            ->line('------------------------------------------------')
            ->line(priceFormat($damageDeposit) . ' USD per property plan (Covers up to: $1,500.00 USD)')
            ->line('------------------------------------------------')
            ->line('PAYMENTS')
            ->line('------------------------------------------------')
            ->line(new HtmlString('TOTAL FOR THE STAY: <strong>' . priceFormat($this->booking->subtotal_nights) . ' USD</strong>'))
            ->line(new HtmlString('DAMAGE INSURANCE: <strong>' . priceFormat($damageDeposit) . ' USD</strong>'))
            ->line(new HtmlString('PAYMENTS: <strong>' . priceFormat($reduced) . ' USD</strong>'))
            ->line(new HtmlString('TOTAL DUE: <strong>' . priceFormat($balance) . ' USD</strong>'))
            ->line(new HtmlString('<br><br>'))
            ->line('Esta es una copia de una reservación:')
            ->line(new HtmlString('CONFIRMACIÓN: <strong>' . $this->booking->id . '</strong>'))
            ->line(new HtmlString('ESTATUS: <strong>' . getBookingStatus($this->booking, 'es') . '<strong>'))
            ->line(new HtmlString('FECHA DE RESERVACIÓN: <strong>' . $this->booking->created_at . '</strong>'))
            ->line('------------------------------------------------')
            ->line('DETALLES DEL VIAJE')
            ->line('------------------------------------------------')
            ->line(new HtmlString('NOMBRE DE LA RESERVA: <strong>' . $this->booking->full_name . '</strong>'))
            ->line(new HtmlString('FECHAS: <strong>' . $this->booking->arrival_date . ' - ' . $this->booking->departure_date . '</strong>'))
            ->line(new HtmlString('TARIFA: <strong>Prom. Noche ' . priceFormat($this->booking->price_per_night) . ' USD | Estancia total ' . priceFormat($this->booking->subtotal_nights) . ' USD</strong>'))
            ->line('------------------------------------------------')
            ->line('DETALLES DE LA PROPIEDAD')
            ->line('------------------------------------------------')
            ->line(new HtmlString('PROPIEDAD: <strong>' . $property->name . '</strong> / <strong>' . $propertyType->name . '</strong> / <strong>' . $bedrooms . ' Recámaras</strong> / <strong>' . $baths . ' Baños</strong>'))
            ->line(new HtmlString('LOCACIÓN: <strong>' . $location->name . '</strong>'))
            ->line(new HtmlString('DIRECCIÓN: <strong>' . $address . '</strong>'))
            ->line('------------------------------------------------')
            ->line('DEPÓSITO DE SEGURIDAD / SEGURO POR DAÑOS ACCIDENTALES')
            ->line('------------------------------------------------')
            ->line(priceFormat($damageDeposit) . ' USD por plan de propiedad (Cubre hasta: $1,500.00 USD)')
            ->line('------------------------------------------------')
            ->line('PAGOS')
            ->line('------------------------------------------------')
            ->line(new HtmlString('TOTAL PARA LA ESTANCIA: <strong>' . priceFormat($this->booking->subtotal_nights) . ' USD</strong>'))
            ->line(new HtmlString('SEGURO DE DAÑOS: <strong>' . priceFormat($damageDeposit) . ' USD</strong>'))
            ->line(new HtmlString('PAGOS: <strong>' . priceFormat($reduced) . ' USD</strong>'))
            ->line(new HtmlString('DEUDA TOTAL: <strong>' . priceFormat($balance) . ' USD</strong>'));
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
