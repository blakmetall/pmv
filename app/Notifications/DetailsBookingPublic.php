<?php

namespace App\Notifications;

use App\Models\PropertyBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class DetailsBookingPublic extends Notification
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
        $currentDate = date("j/F/Y");
        
        $reduced  = 0;

        foreach ($payments as $payment) {
            if($payment->is_paid){
                $reduced += $payment->amount;
            }
        }

        $balance = $total - $reduced;
        $damageDeposit = ($this->booking->subtotal_damage_deposit) ? $this->booking->subtotal_damage_deposit : 0;

        $subject = __('Booking Details') . ' - ' . getBookingStatus($this->booking, \App::getLocale()) . ' - #' . $this->booking->id;

        return (new MailMessage())
            ->subject($subject)
            ->line('This is a copy of a booking:')
            ->line(new HtmlString('CONFIRMATION: <strong>' . $this->booking->id . '</strong>'))
            ->line(new HtmlString('STATUS: <strong>' . getBookingStatus($this->booking, 'en') . '<strong>'))
            ->line(new HtmlString('BOOKING DATE: <strong>' . $this->booking->created_at . '</strong>'))
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line('TRAVEL DETAILS')
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line(new HtmlString('RESERVATION NAME: <strong>' . $this->booking->full_name . '</strong>'))
            ->line(new HtmlString('DATES: <strong>' . $this->booking->arrival_date . ' - ' . $this->booking->departure_date . '</strong>'))
            ->line(new HtmlString('RATE: <strong>Avg. Night ' . priceFormat($this->booking->price_per_night) . ' USD | Total stay ' . priceFormat($this->booking->subtotal_nights) . 'USD</strong>'))
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line('PROPERTY DETAILS')
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line(new HtmlString('PROPERTY: <strong>' . $property->name . '</strong> / <strong>' . $propertyType->name . '</strong> / <strong>' . $bedrooms . ' Bedrooms</strong> / <strong>' . $baths . ' Bathrooms</strong>'))
            ->line(new HtmlString('LOCATION: <strong>' . $location->name . '</strong>'))
            ->line(new HtmlString('ADDRESS: <strong>' . $address . '</strong>'))
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line('SECURITY DEPOSIT / ACCIDENTAL DAMAGE INSURANCE')
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line(priceFormat($damageDeposit) . ' USD per property plan (Covers up to: $1,500.00 USD)')
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line('PAYMENTS')
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line(new HtmlString('TOTAL FOR THE STAY: <strong>' . priceFormat($this->booking->subtotal_nights) . 'USD</strong>'))
            ->line(new HtmlString('DAMAGE INSURANCE: <strong>' . priceFormat($damageDeposit) . ' USD</strong>'))
            ->line(new HtmlString('PAYMENTS: <strong>' . priceFormat($reduced) . 'USD</strong>'))
            ->line(new HtmlString('TOTAL DUE: <strong>' . priceFormat($balance) . 'USD</strong> ON ' . $currentDate))
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line('Thank you for your reservation, we will verify availability and confirm to you within 1 business day, after the reservation has been confirmed we require payment to guarantee the reservation.')
            ->line('Initial Deposit: The initial deposit is due within 5 business days from the date of the booking accordingly to the following conditions.')
            ->line('* 50% deposit is due at time of booking if your reservation arrival date is more than 30 days from the booking date.')
            ->line('* 100% payment is due at time of booking if your reservation arrival date is within 30 days from the booking date.')
            ->line('Final Payment')
            ->line('* Final payment is due 30 days before the arrival of your reservation arrival date is between January 4th. and November 19th.')
            ->line('* Final payment is due 60 days before the arrival of your reservation arrival date is between November 20th. and January 3rd.')
            ->line('Some properties have their own reservation and/or cancellation policies and this information is included in the "Property Policy" section of the reservation document. Whenever this is the case the policies stated in the "Property Policy" will take precedent over the above policy.')
            ->line(new HtmlString('This reservation document is hereby confirmed as a RESERVATION REQUEST ONLY and the reservation is not guaranteed or secured until payment has been received. You may review the Rental Agreement at any time at the following address <a href="http://www.palmeravacations.mx/rental-agreement" target="_blank">http://www.palmeravacations.mx/rental-agreement.</a>'))
            ->line('')
            ->line(new HtmlString('<br><br>'))
            ->line('')
            ->line('Esta es una copia de una reservación:')
            ->line(new HtmlString('CONFIRMACIÓN: <strong>' . $this->booking->id . '</strong>'))
            ->line(new HtmlString('ESTATUS: <strong>' . getBookingStatus($this->booking, 'es') . '<strong>'))
            ->line(new HtmlString('FECHA DE RESERVACIÓN: <strong>' . $this->booking->created_at . '</strong>'))
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line('')
            ->line('DETALLES DEL VIAJE')
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line(new HtmlString('NOMBRE DE LA RESERVA: <strong>' . $this->booking->full_name . '</strong>'))
            ->line(new HtmlString('FECHAS: <strong>' . $this->booking->arrival_date . ' - ' . $this->booking->departure_date . '</strong>'))
            ->line(new HtmlString('TARIFA: <strong>Prom. Noche ' . priceFormat($this->booking->price_per_night) . ' USD | Estancia total ' . priceFormat($this->booking->subtotal_nights) . 'USD</strong>'))
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line('')
            ->line('DETALLES DE LA PROPIEDAD')
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line(new HtmlString('PROPIEDAD: <strong>' . $property->name . '</strong> / <strong>' . $propertyType->name . '</strong> / <strong>' . $bedrooms . ' Recámaras</strong> / <strong>' . $baths . ' Baños</strong>'))
            ->line(new HtmlString('LOCACIÓN: <strong>' . $location->name . '</strong>'))
            ->line(new HtmlString('DIRECCIÓN: <strong>' . $address . '</strong>'))
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line('')
            ->line('DEPÓSITO DE SEGURIDAD / SEGURO POR DAÑOS ACCIDENTALES')
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line(priceFormat($damageDeposit) . ' USD por plan de propiedad (Cubre hasta: $1,500.00 USD)')
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line('')
            ->line('PAGOS')
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line(new HtmlString('TOTAL PARA LA ESTANCIA: <strong>' . priceFormat($this->booking->subtotal_nights) . ' USD</strong>'))
            ->line(new HtmlString('SEGURO DE DAÑOS: <strong>' . priceFormat($damageDeposit) . ' USD</strong>'))
            ->line(new HtmlString('PAGOS: <strong>' . priceFormat($reduced) . ' USD</strong>'))
            ->line(new HtmlString('DEUDA TOTAL: <strong>' . priceFormat($balance) . ' USD</strong> A ' . $currentDate))
            ->line('')
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line('Gracias por su reserva, verificaremos la disponibilidad y le confirmaremos dentro de 1 día hábil, luego de que la reservación haya sido confirmada requerimos el pago para garantizar la reservación.')
            ->line('Depósito inicial: El depósito inicial se debe pagar dentro de los 5 días hábiles a partir de la fecha de la reserva de acuerdo con las siguientes condiciones.')
            ->line('* El depósito del 50% se debe pagar al momento de la reserva si la fecha de llegada de la reserva es más de 30 días desde la fecha de la reserva.')
            ->line('* El pago del 100% debe realizarse al momento de la reserva si la fecha de llegada de la reserva es dentro de los 30 días posteriores a la fecha de la reserva.')
            ->line('Pago final')
            ->line('* El pago final debe realizarse 30 días antes de la fecha de llegada de su reserva, entre el 4 de enero. y 19 de noviembre.')
            ->line('* El pago final debe realizarse 60 días antes de la fecha de llegada de su reserva, entre el 20 de noviembre. y 3 de enero.')
            ->line('Algunas propiedades tienen sus propias políticas de reserva y / o cancelación y esta información se incluye en la sección "Política de la propiedad" del documento de reserva. Siempre que este sea el caso, las políticas establecidas en la "Política de propiedad" prevalecerán sobre la política anterior.')
            ->line(new HtmlString('Este documento de reserva se confirma como SOLICITUD DE RESERVA SOLAMENTE y la reserva no está garantizada ni asegurada hasta que se haya recibido el pago. Puede revisar el contrato de alquiler en cualquier momento en la siguiente dirección <a href="http://www.palmeravacations.mx/rental-agreement" target="_blank">http://www.palmeravacations.mx/rental-agreement.</a>'))
            ->line(new HtmlString('– – – – – – – – – – – – – – – – – – – – – – –'))
            ->line('Palmera Vacations')
            ->line('vallarta@palmeravacations.com')
            ->line('Local:  +52 (322) 223-0101')
            ->line('US/Canada:  (323) 250-7721')
            ->line('Libertad 349 - Puerto Vallarta - Jal. - México 48380')
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
