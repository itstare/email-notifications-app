<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Passenger;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = ['direction', 'flight_number', 'dep_airport', 'arv_airport', 'dep_time', 'arv_time'];

    public function airport() {
    	$string = $this->dep_airport .' - '. $this->arv_airport;	
    	return $string;
    }

    public function time() {
    	$departure = Carbon::createFromFormat('H:i:s', $this->dep_time)->format('H:i');
    	$arrival = Carbon::createFromFormat('H:i:s', $this->arv_time)->format('H:i');
    	$string = $departure .' - '. $arrival;
    	return $string;
    }

    public function departureTime() {
        return Carbon::createFromFormat('H:i:s', $this->dep_time)->format('H:i');
    }

    public function arrivalTime() {
        return Carbon::createFromFormat('H:i:s', $this->arv_time)->format('H:i');
    }

    public function flightString() {
        return $this->flight_number .' ('. $this->dep_airport . ' - ' . $this->arv_airport . ')'; 
    }

    public function passengers() {
        return $this->belongsToMany(Passenger::class);
    }
}
