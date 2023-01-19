<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Flight;
use Carbon\Carbon;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'travel_date', 'return_date', 'notification'];

    public function fullName() {
    	return $this->first_name .' '. $this->last_name;
    }

    public function travelDateString() {
    	$travelDate = Carbon::parse($this->travel_date)->format('d-M-Y');
    	$flight = $this->flights()->where('direction', 'outbound')->first();
    	
    	if($flight) {
    		return $travelDate .' ('. $flight->flight_number . ')';
    	} else {
    		return null;
    	}
    }

    public function returnDateString() {
    	$returnDate = Carbon::parse($this->return_date)->format('d-M-Y');
    	$flight = $this->flights()->where('direction', 'inbound')->first();

    	if($flight) {
    		return $returnDate .' ('. $flight->flight_number . ')';
    	} else {
    		return null;
    	}
    }

    public function travelDate() {
        if($this->travel_date) {
            $travelDate = Carbon::parse($this->travel_date)->format('d-M-Y');
            return $travelDate;
        } else {
            return 'N/A';
        }
    }

    public function outboundFlight() {
        $flight = $this->flights()->where('direction', 'outbound')->first();

        if($flight) {
            return $flight->flight_number .' ('. $flight->dep_airport .' - '. $flight->arv_airport . ')';
        } else {
            return 'N/A';
        }
    }

    public function returnDate() {
        if($this->return_date) {
            $returnDate = Carbon::parse($this->return_date)->format('d-M-Y');
            return $returnDate;
        } else {
            return 'N/A';
        }
    }

    public function inboundFlight() {
        $flight = $this->flights()->where('direction', 'inbound')->first();

        if($flight) {
            return $flight->flight_number .' ('. $flight->dep_airport .' - '. $flight->arv_airport . ')';
        } else {
            return 'N/A';
        }
    }

    public function flights() {
    	return $this->belongsToMany(Flight::class);
    }
}
