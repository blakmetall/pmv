<?php

namespace App\Notifications;

use App\Models\PropertyBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class BookingDetails extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(PropertyBooking $booking, $isNew, $isTeam)
    {
        $this->booking = $booking;
        $this->isNew = $isNew;
        $this->isTeam = $isTeam;
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
    
        // subject
        if($this->isNew) {
            $subject = __('Palmera Vacations New Reservation') . ' #' . $this->booking->id;
        }else{
            $subject = __('Palmera Vacations') . ' ' . getSubjectBookingStatus($this->booking, \App::getLocale(), $this->isNew) . ' #' . $this->booking->id;
        }

        $mailMsg = new MailMessage();
        $mailMsg->subject($subject);

        if(\App::getLocale() == 'en') {
            // introduction
            if($this->isTeam) {
                $mailMsg->line(new HtmlString('Hello Team,'));
            }else{
                $guestName = $this->booking->firstname . ' ' . $this->booking->lastname;
                $mailMsg->line(new HtmlString('Hello ' . $guestName));
            }

            $createdAt = explode(' ', $this->booking->created_at);
            
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('This is a copy of the booking'));
            
            // booking status
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('CONFIRMATION: ' . $this->booking->id));
            $mailMsg->line(new HtmlString('STATUS: ' . getBookingStatus($this->booking, 'en')));
            $mailMsg->line(new HtmlString('BOOKING DATE: ' . getReadableDate($createdAt[0], 'en') . ' ' . $createdAt[1]));
            
            // travel details
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('TRAVEL DETAILS'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('RESERVATION NAME: ' . $this->booking->full_name));
            $mailMsg->line(new HtmlString('DATES: ' . getReadableDate($this->booking->arrival_date, 'en') . ' - ' . getReadableDate($this->booking->departure_date)));
            $mailMsg->line(new HtmlString('RATE: Avg. Night ' . priceFormat($this->booking->price_per_night) . ' USD | Total stay ' . priceFormat($this->booking->subtotal_nights) . 'USD'));
            
            // property details
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('PROPERTY DETAILS'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('PROPERTY: ' . $property->name . ' / ' . $propertyType->name . ' / ' . $bedrooms . ' Bedrooms / ' . $baths . ' Bathrooms'));
            $mailMsg->line(new HtmlString('LOCATION: ' . $location->name));
            $mailMsg->line(new HtmlString('ADDRESS: ' . $address));
            
            // flight information
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('FLIGHT INFORMATION'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));

            // arrival info
            if($this->booking->arrival_airline) {
                $mailMsg->line(new HtmlString('Arrival airline: ' . $this->booking->arrival_airline));
                $mailMsg->line(new HtmlString('Flight number: ' . $this->booking->arrival_flight_number));
                $mailMsg->line(new HtmlString('Arrival date: ' . getReadableDate($this->booking->arrival_date)));
                $mailMsg->line(new HtmlString('Arrival time: ' . $this->booking->arrival_time));
                $mailMsg->line(new HtmlString('Check in: ' . $this->booking->check_in));
                $mailMsg->line(new HtmlString('Requires transportation: ' . ($this->booking->arrival_transportation ? 'Yes' : 'No')));
                $mailMsg->line(new HtmlString('Arrival notes: ' . $this->booking->arrival_notes));
                $mailMsg->line(new HtmlString('<br>'));
            }else{
                $mailMsg->line(new HtmlString('Arrival: N/A'));
            }

            // departure info
            if($this->booking->departure_airline) {
                $mailMsg->line(new HtmlString('Departure airline: ' . $this->booking->departure_airline));
                $mailMsg->line(new HtmlString('Flight number: ' . $this->booking->departure_flight_number));
                $mailMsg->line(new HtmlString('Departure date: ' . getReadableDate($this->booking->departure_date)));
                $mailMsg->line(new HtmlString('Departure time: ' . $this->booking->departure_time));
                $mailMsg->line(new HtmlString('Check out: ' . $this->booking->check_out));
                $mailMsg->line(new HtmlString('Requires transportation: ' . ($this->booking->arrival_transportation ? 'Yes' : 'No')));
                $mailMsg->line(new HtmlString('Departure notes: ' . $this->booking->arrival_notes));
            }else{
                $mailMsg->line(new HtmlString('Departure: N/A'));
            }
            
            // security deposit info
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('SECURITY DEPOSIT / ACCIDENTAL DAMAGE INSURANCE'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));

            if($this->booking->damageDeposit) {
                $mailMsg->line(new HtmlString($this->booking->damageDeposit->translate()->description));
            }else{
                $mailMsg->line(new HtmlString('$0.00'));
            }

            // payments section
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('PAYMENTS'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));

            $mailMsg->line(new HtmlString('TOTAL FOR THE STAY: ' . priceFormat($this->booking->subtotal_nights) . ' USD'));
            $mailMsg->line(new HtmlString('DAMAGE INSURANCE: ' . priceFormat($damageDeposit) . ' USD'));
            $mailMsg->line(new HtmlString('PAYMENTS: ' . priceFormat($reduced) . ' USD'));
            $mailMsg->line(new HtmlString('TOTAL DUE: ' . priceFormat($balance) . ' USD'));

            if(!$this->isTeam) {
                // utilize pmv addresses   
            }

            $date = getReadableDate(date('Y-m-d', strtotime('now')));
            $time = date('H:i:s', strtotime('now'));

            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('<br>'));

            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('Date: ' . $date . ' ' . $time . ' - End of message.'));

            return $mailMsg; // end english msg

        }else {
            // introduction
            if($this->isTeam) {
                $mailMsg->line(new HtmlString('Hola equipo,'));
            }else{
                $guestName = $this->booking->firstname . ' ' . $this->booking->lastname;
                $mailMsg->line(new HtmlString('Hola ' . $guestName));
            }

            $createdAt = explode(' ', $this->booking->created_at);
            
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('Esta es una copia de la reservación'));
            
            // booking status
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('CONFIRMACIÓN: ' . $this->booking->id));
            $mailMsg->line(new HtmlString('ESTATUS: ' . getBookingStatus($this->booking, 'es')));
            $mailMsg->line(new HtmlString('FECHA DE RESERVACIÓN: ' . getReadableDate($createdAt[0], 'es') . ' ' . $createdAt[1]));
            
            // travel details
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('DETALLES DEL VIAJE'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('NOMBRE DE LA RESERVACIÓN: ' . $this->booking->full_name));
            $mailMsg->line(new HtmlString('FECHAS: ' . getReadableDate($this->booking->arrival_date, 'en') . ' - ' . getReadableDate($this->booking->departure_date)));
            $mailMsg->line(new HtmlString('TARIFA: Prom. noche ' . priceFormat($this->booking->price_per_night) . ' USD | Total estancia ' . priceFormat($this->booking->subtotal_nights) . 'USD'));
            
            // property details
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('DETALLES DE LA PROPIEDAD'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('PROPIEDAD: ' . $property->name . ' / ' . $propertyType->name . ' / ' . $bedrooms . ' Bedrooms / ' . $baths . ' Bathrooms'));
            $mailMsg->line(new HtmlString('UBICACIÓN: ' . $location->name));
            $mailMsg->line(new HtmlString('DIRECCIÓN: ' . $address));
            
            // flight information
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('INFORMACIÓN DEL VUELO'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));

            // arrival info
            if($this->booking->arrival_airline) {
                $mailMsg->line(new HtmlString('Aerolínea de llegada: ' . $this->booking->arrival_airline));
                $mailMsg->line(new HtmlString('Número de vuelo: ' . $this->booking->arrival_flight_number));
                $mailMsg->line(new HtmlString('Fecha de llegada: ' . getReadableDate($this->booking->arrival_date)));
                $mailMsg->line(new HtmlString('Hora de llegada: ' . $this->booking->arrival_time));
                $mailMsg->line(new HtmlString('Entrada: ' . $this->booking->check_in));
                $mailMsg->line(new HtmlString('Requiere transportación: ' . ($this->booking->arrival_transportation ? 'Yes' : 'No')));
                $mailMsg->line(new HtmlString('Notas de llegada: ' . $this->booking->arrival_notes));
                $mailMsg->line(new HtmlString('<br>'));

            }else{
                $mailMsg->line(new HtmlString('Llegada: N/A'));
            }

            // departure info
            if($this->booking->departure_airline) {
                $mailMsg->line(new HtmlString('Aerolínea de salida: ' . $this->booking->departure_airline));
                $mailMsg->line(new HtmlString('Número de vuevlo: ' . $this->booking->departure_flight_number));
                $mailMsg->line(new HtmlString('Fecha de salida: ' . getReadableDate($this->booking->departure_date)));
                $mailMsg->line(new HtmlString('Hora de salida: ' . $this->booking->departure_time));
                $mailMsg->line(new HtmlString('Salida: ' . $this->booking->check_out));
                $mailMsg->line(new HtmlString('Requiere transportación: ' . ($this->booking->arrival_transportation ? 'Yes' : 'No')));
                $mailMsg->line(new HtmlString('Notas de salida: ' . $this->booking->arrival_notes));
            }else{
                $mailMsg->line(new HtmlString('Salida: N/A'));
            }
            
            // security deposit info
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('DEPÓSITO DE SEGURIDAD / SEGURO DE DAÑOS ACCIDENTALES'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));

            if($this->booking->damageDeposit) {
                $mailMsg->line(new HtmlString($this->booking->damageDeposit->translate()->description));
            }else{
                $mailMsg->line(new HtmlString('$0.00'));
            }

            // payments section
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('PAGOS'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));

            $mailMsg->line(new HtmlString('TOTAL DE LA ESTANCIA: ' . priceFormat($this->booking->subtotal_nights) . ' USD'));
            $mailMsg->line(new HtmlString('SEGURO DE DAÑOS: ' . priceFormat($damageDeposit) . ' USD'));
            $mailMsg->line(new HtmlString('PAGOS: ' . priceFormat($reduced) . ' USD'));
            $mailMsg->line(new HtmlString('TOTAL: ' . priceFormat($balance) . ' USD'));

            if(!$this->isTeam) {
                // utilize pmv addresses   
            }

            $date = getReadableDate(date('Y-m-d', strtotime('now')));
            $time = date('H:i:s', strtotime('now'));

            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('<br>'));

            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('Fecha: ' . $date . ' ' . $time . ' - Fin del mensaje.'));

            return $mailMsg; // end spanish msg
        }
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
