<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\AppModel;

class User extends Authenticatable {

    use AppModel;
    use Notifiable;

    protected $table = 'users';
    public $timestamps = true;
    protected $fillable = [
        'email',
        'is_enabled'
    ];
    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function roles() {
        return $this->belongsToMany('App\Models\Role', 'user_has_roles');
    }

    public function profile() {
        return $this->hasOne('App\Models\Profile');
    }

    public function properties() {
        return $this->hasMany('App\Models\Property');
    }

    public function booking() {
        return $this->hasMany('App\Models\Booking');
    }

    public function agentBooking() {
        return $this->hasMany('App\Models\Booking', 'user_agent_id');
    }

    public function bookingCommissions() {
        return $this->hasMany('App\Models\BookingCommission');
    }

    public function reservationRequests() {
        return $this->hasMany('App\Models\ReservationRequest');
    }

    public function notifications() {
        return $this->hasMany('App\Models\Notification');
    }

    public function auditedReservationRequests() {
        return $this->hasMany('App\Models\ReservationRequest', 'audit_user_id');
    }

    public function auditedBookings() {
        return $this->hasMany('App\Models\Booking', 'audit_user_id');
    }

    public function auditedBookingRefunds() {
        return $this->hasMany('App\Models\Booking', 'audit_refund_user_id');
    }

    public function auditedPropertyManagementTransactions() {
        return $this->hasMany('App\Models\PropertyManagementTransaction', 'audit_user_id');
    }

    public function auditedPropertyManagementPayments() {
        return $this->hasMany('App\Models\CleaningService', 'audit_user_id');
    }

    public function auditedCleaningServices() {
        return $this->hasMany('App\Models\CleaningService', 'audit_user_id');
    }

    public function auditedBookingCommisions() {
        return $this->hasMany('App\Models\BookingCommission', 'audit_user_id');
    }

    public function auditedBookingExtraPayments() {
        return $this->hasMany('App\Models\BookingExtraPayment', 'audit_user_id');
    }

}
