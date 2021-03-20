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
            $reduced += $payment->amount;
        }
        $balance = $total - $reduced;
        $damageDeposit = ($this->booking->subtotal_damage_deposit) ? $this->booking->subtotal_damage_deposit : 0;

        return (new MailMessage())
            ->subject('Details of Booking' . ' - ' . $this->booking->id)
            ->greeting(sprintf('Hello Accounting'))
            ->line('This is a copy of a booking:')
            ->line('CONFIRMATION: <strong>' . $this->booking->id . '</strong>')
            ->line('STATUS: <strong>Booked<strong>')
            ->line('BOOKING DATE: <strong>' . $this->booking->create_at . '</strong>')
            ->line('------------------------------------------------')
            ->line('TRAVEL DETAILS')
            ->line('------------------------------------------------')
            ->line('RESERVATION NAME: <strong>' . $this->booking->full_name . '</strong>')
            ->line('DATES: <strong>' . $this->booking->arrival_date . ' - ' . $this->booking->departure_date . '</strong>')
            ->line('RATE: <strong>Avg. Night' . priceFormat($this->booking->price_per_night) . 'USD | Total stay ' . priceFormat($this->booking->subtotal_nights) . 'USD</strong>')
            ->line('------------------------------------------------')
            ->line('PROPERTY DETAILS')
            ->line('------------------------------------------------')
            ->line('PROPERTY: <strong>' . $property->name . '</strong> / <strong>' . $propertyType->name . '</strong> / <strong>' . $bedrooms . ' Bedrooms</strong> / <strong>' . $baths . ' Bathrooms</strong>')
            ->line('LOCATION: <strong>' . $location . '</strong>')
            ->line('ADDRESS: <strong>' . $address . '</strong>')
            ->line('------------------------------------------------')
            ->line('SECURITY DEPOSIT / ACCIDENTAL DAMAGE INSURANCE')
            ->line('------------------------------------------------')
            ->line(priceFormat($damageDeposit) . ' USD per property plan (Covers up to: $1,500.00 USD)')
            ->line('------------------------------------------------')
            ->line('PAYMENTS')
            ->line('------------------------------------------------')
            ->line('TOTAL FOR THE STAY: <strong>' . priceFormat($this->booking->subtotal_nights) . 'USD</strong>')
            ->line('DAMAGE INSURANCE: <strong>' . priceFormat($damageDeposit) . 'USD</strong>')
            ->line('PAYMENTS: <strong>' . priceFormat($reduced) . 'USD</strong>')
            ->line('TOTAL DUE: <strong>' . priceFormat($balance) . 'USD</strong>')
            ->line('------------------------------------------------')
            ->greeting(sprintf('Hola'))
            ->line('Esta es una copia de una reservación:')
            ->line('CONFIRMACIÓN: <strong>' . $this->booking->id . '</strong>')
            ->line('ESTATUS: <strong>Booked<strong>')
            ->line('FECHA DE RESERVACIÓN: <strong>' . $this->booking->create_at . '</strong>')
            ->line('------------------------------------------------')
            ->line('DETALLES DEL VIAJE')
            ->line('------------------------------------------------')
            ->line('NOMBRE DE LA RESERVA: <strong>' . $this->booking->full_name . '</strong>')
            ->line('FECHAS: <strong>' . $this->booking->arrival_date . ' - ' . $this->booking->departure_date . '</strong>')
            ->line('TARIFA: <strong>Prom. Noche' . priceFormat($this->booking->price_per_night) . 'USD | Estancia total ' . priceFormat($this->booking->subtotal_nights) . 'USD</strong>')
            ->line('------------------------------------------------')
            ->line('DETALLES DE LA PROPIEDAD')
            ->line('------------------------------------------------')
            ->line('PROPIEDAD: <strong>' . $property->name . '</strong> / <strong>' . $propertyType->name . '</strong> / <strong>' . $bedrooms . ' Recámaras</strong> / <strong>' . $baths . ' Baños</strong>')
            ->line('LOCACIÓN: <strong>' . $location . '</strong>')
            ->line('DIRECCIÓN: <strong>' . $address . '</strong>')
            ->line('------------------------------------------------')
            ->line('DEPÓSITO DE SEGURIDAD / SEGURO POR DAÑOS ACCIDENTALES')
            ->line('------------------------------------------------')
            ->line(priceFormat($damageDeposit) . ' USD por plan de propiedad (Cubre hasta: $1,500.00 USD)')
            ->line('------------------------------------------------')
            ->line('PAGOS')
            ->line('------------------------------------------------')
            ->line('TOTAL PARA LA ESTANCIA: <strong>' . priceFormat($this->booking->subtotal_nights) . 'USD</strong>')
            ->line('SEGURO DE DAÑOS: <strong>' . priceFormat($damageDeposit) . 'USD</strong>')
            ->line('PAGOS: <strong>' . priceFormat($reduced) . 'USD</strong>')
            ->line('DEUDA TOTAL: <strong>' . priceFormat($balance) . 'USD</strong>');
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
