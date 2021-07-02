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
    public function __construct(PropertyBooking $booking, $isNew, $isTeam, $isDeleted)
    {
        $this->booking = $booking;
        $this->isNew = $isNew;
        $this->isTeam = $isTeam;
        $this->isDeleted = $isDeleted;
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

        $damageDeposit = ($this->booking->subtotal_damage_deposit) ? $this->booking->subtotal_damage_deposit : 0;
        $balance = $total - $reduced + $damageDeposit;
    
        // subject
        if($this->isNew) {
            $subject = __('Palmera Vacations NEW RESERVATION') . ' #' . $this->booking->id;
        }else{
            if($this->isDeleted) {
                $subject = __('Palmera Vacations') . ' ' . 'RESERVATION DELETED' . ' #' . $this->booking->id;
            }else if($this->booking->is_cancelled) {
                $subject = __('Palmera Vacations') . ' ' . 'RESERVATION CANCELLED' . ' #' . $this->booking->id;
            }else{
                $subject = __('Palmera Vacations') . ' ' . 'RESERVATION UPDATE' . ' #' . $this->booking->id;
            }
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
            
            $mailMsg->line(new HtmlString('<br>'));

            if($this->isTeam){
                $mailMsg->line(new HtmlString('This is a copy of the booking'));
            }else{
                $mailMsg->line(new HtmlString('Below are the details of your reservation'));
            }

            $createdAt = explode(' ', $this->booking->created_at);
            
            // booking status
            $mailMsg->line(new HtmlString('<br>'));

            if($this->isDeleted) {
                $mailMsg->line(new HtmlString('RESERVATION DELETED'));
            }else if($this->booking->is_cancelled) {
                $mailMsg->line(new HtmlString('RESERVATION CANCELLED'));
            }else if(!$this->isNew){
                $mailMsg->line(new HtmlString('RESERVATION UPDATE'));
            }

            $mailMsg->line(new HtmlString('BOOKING DATE: ' . getReadableDate($createdAt[0], 'en') . ' ' . $createdAt[1]));
            $mailMsg->line(new HtmlString('STATUS: ' . getBookingStatus($this->booking, 'en')));
            
            // travel details
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('TRAVEL DETAILS'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('CONFIRMATION: ' . $this->booking->id));
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

            // payments list
            if(count($payments)){
                foreach($payments as $payment){
                    if($payment->is_paid) {
                        $transactionSource = $payment->transactionSource->translations()->where('language_id', 1)->first();
                        $mailMsg->line(new HtmlString('* ' . getReadableDate($payment->post_date, 'en') . ' | ' . priceFormat($payment->amount) . ' USD | ' . $transactionSource->name));
                    }
                }
            }

            // total due
            $mailMsg->line(new HtmlString('TOTAL DUE: ' . priceFormat($balance) . ' USD'));

            // if not for the pmv team send extra instructions
            if(!$this->isTeam) {  
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
                $mailMsg->line(new HtmlString('Thank you for your reservation, we will verify availability and confirm to'));
                $mailMsg->line(new HtmlString('you within 1 business day, after the reservation has been confirmed we'));
                $mailMsg->line(new HtmlString('require payment to guarantee the reservation.'));
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('Initial Deposit: The initial deposit is due within 5 business days from the'));
                $mailMsg->line(new HtmlString('date of the booking accordingly to the following conditions.'));
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('   * 50% deposit is due at time of booking if your reservation arrival date'));
                $mailMsg->line(new HtmlString('     is more than 30 days from the booking date.'));
                $mailMsg->line(new HtmlString('   * 100% payment is due at time of booking if your reservation arrival'));
                $mailMsg->line(new HtmlString('     date is within 30 days from the booking date.'));
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('Final Payment'));
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('   * Final payment is due 30 days before the arrival of your reservation'));
                $mailMsg->line(new HtmlString('     arrival date is between January 4th. and November 19th.'));
                $mailMsg->line(new HtmlString('   * Final payment is due 60 days before the arrival of your reservation'));
                $mailMsg->line(new HtmlString('     arrival date is between November 20th. and January 3rd.'));
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('Some properties have their own reservation and/or cancellation policies and'));
                $mailMsg->line(new HtmlString('this information is included in the "Property Policy" section of the reservation document.'));
                $mailMsg->line(new HtmlString('Whenever this is the case the policies stated in the "Property Policy" will take precedent over'));
                $mailMsg->line(new HtmlString('the above policy.'));
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('This reservation document is hereby confirmed as a RESERVATION REQUEST ONLY and '));
                $mailMsg->line(new HtmlString('the reservation is not guaranteed or secured until payment has been received.'));
                $mailMsg->line(new HtmlString('You may review the Rental Agreement at any time at the following address <a href="https://www.palmeravacations.mx/en/rental-agreement" target="_blank">https://palmeravacations.mx/en/rental-agreement.</a>'));
            }

            // if not for the pmv team, send addresses information
            if(!$this->isTeam) {
                // pv address
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
                $mailMsg->line(new HtmlString('Palmera Vacations'));
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('Puerto Vallarta'));
                $mailMsg->line(new HtmlString('<a href="mailto:vallarta@palmeravacations.com">vallarta@palmeravacations.com</a>'));
                $mailMsg->line(new HtmlString('Tel: +52 (322) 223-0101'));
                $mailMsg->line(new HtmlString('US/Canada: (323) 250-7721'));
                $mailMsg->line(new HtmlString('Libertad 349, Centro'));
                $mailMsg->line(new HtmlString('Puerto Vallarta, Jalisco, México 48380'));
                $mailMsg->line(new HtmlString('<br>'));

                // mz address
                $mailMsg->line(new HtmlString('Mazatlan'));
                $mailMsg->line(new HtmlString('<a href="mailto:mazatlan@palmeravacations.com">mazatlan@palmeravacations.com</a>'));
                $mailMsg->line(new HtmlString('Tel: +52 (669) 913-5188'));
                $mailMsg->line(new HtmlString('Ave. Playa Gaviotas 409 Local 27'));
                $mailMsg->line(new HtmlString('Mazatlán, Sinaloa, México 82110'));
            }

            // end of message block
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
            
            $mailMsg->line(new HtmlString('<br>'));
            
            if($this->isTeam) {
                $mailMsg->line(new HtmlString('Esta es una copia de la reservación'));
            }else{
                $mailMsg->line(new HtmlString('A continuación se muestran los detalles de su reservación:'));
            }

            $createdAt = explode(' ', $this->booking->created_at);
            
            // booking status
            $mailMsg->line(new HtmlString('<br>'));

            if($this->isDeleted) {
                $mailMsg->line(new HtmlStrin('RESERVACIÓN ELIMINADA'));
            }else if($this->booking->is_cancelled) {
                $mailMsg->line(new HtmlStrin('RESERVACIÓN CANCELADA'));
            }else if(!$this->isNew){
                $mailMsg->line(new HtmlStrin('RESERVACIÓN ACTUALIZADA'));
            }

            $mailMsg->line(new HtmlString('FECHA DE RESERVACIÓN: ' . getReadableDate($createdAt[0], 'es') . ' ' . $createdAt[1]));
            $mailMsg->line(new HtmlString('ESTATUS: ' . getBookingStatus($this->booking, 'es')));
            
            // travel details
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('DETALLES DEL VIAJE'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('CONFIRMACIÓN: ' . $this->booking->id));
            $mailMsg->line(new HtmlString('NOMBRE DE LA RESERVACIÓN: ' . $this->booking->full_name));
            $mailMsg->line(new HtmlString('FECHAS: ' . getReadableDate($this->booking->arrival_date, 'en') . ' - ' . getReadableDate($this->booking->departure_date)));
            $mailMsg->line(new HtmlString('TARIFA: Prom. noche ' . priceFormat($this->booking->price_per_night) . ' USD | Total estancia ' . priceFormat($this->booking->subtotal_nights) . 'USD'));
            
            // property details
            $mailMsg->line(new HtmlString('<br>'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('DETALLES DE LA PROPIEDAD'));
            $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
            $mailMsg->line(new HtmlString('PROPIEDAD: ' . $property->name . ' / ' . $propertyType->name . ' / ' . $bedrooms . ' Recámaras / ' . $baths . ' Baños'));
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
                $mailMsg->line(new HtmlString('Número de vuelo: ' . $this->booking->departure_flight_number));
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

            // payments list
            if(count($payments)){
                foreach($payments as $payment){
                    if($payment->is_paid) {
                        $transactionSource = $payment->transactionSource->translations()->where('language_id', 2)->first();
                        $mailMsg->line(new HtmlString('* ' . getReadableDate($payment->post_date, 'es') . ' | ' . priceFormat($payment->amount) . ' USD | ' . $transactionSource->name));
                    }
                }
            }

            $mailMsg->line(new HtmlString('TOTAL POR PAGAR: ' . priceFormat($balance) . ' USD'));

            // if not for the pmv team send extra instructions
            if(!$this->isTeam) {
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
                $mailMsg->line(new HtmlString('Gracias por su reservación, verificaremos la disponibilidad y le'));
                $mailMsg->line(new HtmlString('confirmaremos en un plazo de 1 día hábil, una vez que la reservación haya'));
                $mailMsg->line(new HtmlString('sido confirmada, requerimos el pago para garantizarla.'));
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('Depósito inicial: El depósito inicial se debe realizar dentro de 5 días'));
                $mailMsg->line(new HtmlString('hábiles a partir de la fecha de confirmación de la reservación según las'));
                $mailMsg->line(new HtmlString('siguientes condiciones.'));
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('   * 50% el depósito se debe al momento de reservar si la fecha de llegada'));
                $mailMsg->line(new HtmlString('     de la reservación es en más de 30 días a partir de la fecha que se hizo la reservación'));
                $mailMsg->line(new HtmlString('   * 100% el pago se debe realizar en el momento de reservar si la fecha de'));
                $mailMsg->line(new HtmlString('     llegada de la reservación es dentro de los 30 días posteriores a la fecha que se hizo la reservación.'));
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('Pago final'));
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('   * El pago final se debe realizar 30 días antes de la llegada si la'));
                $mailMsg->line(new HtmlString('     fecha de llegada de su reservación es entre el 4 de Enero y el 19 de Noviembre.'));
                $mailMsg->line(new HtmlString('   * El pago final se debe 60 días antes de la llegada si la fecha de'));
                $mailMsg->line(new HtmlString('     llegada de su reservación es entre el 20 de Noviembre y 3 de Enero.'));
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('Algunas propiedades tienen sus propias políticas de reservación y/o'));
                $mailMsg->line(new HtmlString('cancelación y esta información se incluye en la sección "Política de'));
                $mailMsg->line(new HtmlString('propiedad" del documento de confirmación. Siempre que éste sea el caso, las'));
                $mailMsg->line(new HtmlString('políticas establecidas en la "Política de propiedad" tendrán prioridad'));
                $mailMsg->line(new HtmlString('sobre la política anterior.'));
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('Este documento de reservación se confirma como SOLICITUD DE RESERVACIÓN'));
                $mailMsg->line(new HtmlString('SOLAMENTE y la reservación no está garantizada hasta que se haya recibido'));
                $mailMsg->line(new HtmlString('el pago. Puede revisar el Contrato de Renta en cualquier momento en la'));
                $mailMsg->line(new HtmlString('siguiente dirección <a href="https://www.palmeravacations.mx/es/rental-agreement" target="_blank">https://palmeravacations.mx/es/rental-agreement.</a>'));
            }

            // if not for the pmv team, send addresses information
            if(!$this->isTeam) {
                // pv address
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('––––––––––––––––––––––––––––––––––––––––'));
                $mailMsg->line(new HtmlString('Palmera Vacations'));
                $mailMsg->line(new HtmlString('<br>'));
                $mailMsg->line(new HtmlString('Puerto Vallarta'));
                $mailMsg->line(new HtmlString('<a href="mailto:vallarta@palmeravacations.com">vallarta@palmeravacations.com</a>'));
                $mailMsg->line(new HtmlString('Tel: +52 (322) 223-0101'));
                $mailMsg->line(new HtmlString('US/Canada: (323) 250-7721'));
                $mailMsg->line(new HtmlString('Libertad 349, Centro'));
                $mailMsg->line(new HtmlString('Puerto Vallarta, Jalisco, México 48380'));
                $mailMsg->line(new HtmlString('<br>'));

                // mz address
                $mailMsg->line(new HtmlString('Mazatlan'));
                $mailMsg->line(new HtmlString('<a href="mailto:mazatlan@palmeravacations.com">mazatlan@palmeravacations.com</a>'));
                $mailMsg->line(new HtmlString('Tel: +52 (669) 913-5188'));
                $mailMsg->line(new HtmlString('Ave. Playa Gaviotas 409 Local 27'));
                $mailMsg->line(new HtmlString('Mazatlán, Sinaloa, México 82110'));
            }


            // end of message block
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
