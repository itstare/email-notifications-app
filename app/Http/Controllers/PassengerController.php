<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Passenger;
use Illuminate\Validation\Rule;

class PassengerController extends Controller
{
    public function index() {
        $notifications = Passenger::simplePaginate(25);

        return view('passenger.index', compact('notifications'));
    }

    public function create() {
    	$outboundFlights = Flight::where('direction', 'outbound')->get();
    	$inboundFlights = Flight::where('direction', 'inbound')->get();

    	return view('passenger.create')->with([
    		'outboundFlights' => $outboundFlights,
    		'inboundFlights' => $inboundFlights
    	]);
    }

    public function insert(Request $request) {
    	$rules = [
    		'first_name' => ['required', 'string', 'max:60'],
    		'last_name' => ['required', 'string', 'max:70'],
    		'travel_date' => ['nullable', 'date', Rule::requiredIf(is_null($request->return_date)), Rule::requiredIf(!is_null($request->outbound_flight))],
    		'return_date' => ['nullable', 'date', Rule::requiredIf(is_null($request->travel_date)), Rule::requiredIf(!is_null($request->inbound_flight))],
    		'outbound_flight' => ['nullable', 'numeric', 'integer', Rule::requiredIf(!is_null($request->travel_date))],
    		'inbound_flight' => ['nullable', 'numeric', 'integer', Rule::requiredIf(!is_null($request->return_date))],
    		'notification' => ['required']
    	];
    	$request->validate($rules);

    	if($request->travel_date && $request->return_date) {
    		$passenger = Passenger::create([
    			'first_name' => $request->first_name,
    			'last_name' => $request->last_name,
    			'travel_date' => $request->travel_date,
    			'return_date' => $request->return_date,
    			'notification' => $request->notification
    		]);
    		$passenger->flights()->attach([$request->outbound_flight, $request->inbound_flight]);

    		return redirect()->route('passenger.index')->with('status', 'Notification successfully created.');
    	} else if($request->travel_date && is_null($request->return_date)) {
    		$passenger = Passenger::create([
    			'first_name' => $request->first_name,
    			'last_name' => $request->last_name,
    			'travel_date' => $request->travel_date,
    			'return_date' => null,
    			'notification' => $request->notification
    		]);
    		$passenger->flights()->attach([$request->outbound_flight]);

    		return redirect()->route('passenger.index')->with('status', 'Notification successfully created.');
    	} else {
    		$passenger = Passenger::create([
    			'first_name' => $request->first_name,
    			'last_name' => $request->last_name,
    			'travel_date' => null,
    			'return_date' => $request->return_date,
    			'notification' => $request->notification
    		]);
    		$passenger->flights()->attach([$request->inbound_flight]);

    		return redirect()->route('passenger.index')->with('status', 'Notification successfully created.');
    	}	
    }

    public function view($id) {
        $notification = Passenger::where('id', $id)->firstOrFail();

        return view('passenger.view', compact('notification'));
    }

    public function edit($id) {
        $notification = Passenger::where('id', $id)->firstOrFail();
        $outboundFlights = Flight::where('direction', 'outbound')->get();
        $inboundFlights = Flight::where('direction', 'inbound')->get();
        $flightOutbound = $notification->flights()->where('direction', 'outbound')->first();
        $flightInbound = $notification->flights()->where('direction', 'inbound')->first();

        return view('passenger.edit')->with([
            'notification' => $notification,
            'outboundFlights' => $outboundFlights,
            'inboundFlights' => $inboundFlights,
            'flightOutbound' => $flightOutbound ? $flightOutbound->id : null,
            'flightInbound' => $flightInbound ? $flightInbound->id : null
        ]);
    }

    public function update(Request $request, $id) {
        $rules = [
            'first_name' => ['required', 'string', 'max:60'],
            'last_name' => ['required', 'string', 'max:70'],
            'travel_date' => ['nullable', 'date', Rule::requiredIf(is_null($request->return_date)), Rule::requiredIf(!is_null($request->outbound_flight))],
            'return_date' => ['nullable', 'date', Rule::requiredIf(is_null($request->travel_date)), Rule::requiredIf(!is_null($request->inbound_flight))],
            'outbound_flight' => ['nullable', 'numeric', 'integer', Rule::requiredIf(!is_null($request->travel_date))],
            'inbound_flight' => ['nullable', 'numeric', 'integer', Rule::requiredIf(!is_null($request->return_date))],
            'notification' => ['required']
        ];
        $request->validate($rules);

        $notification = Passenger::where('id', $id)->firstOrFail();

        if($request->travel_date && $request->return_date) {
            $notification->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'travel_date' => $request->travel_date,
                'return_date' => $request->return_date,
                'notification' => $request->notification
            ]);
            $notification->flights()->sync([$request->outbound_flight, $request->inbound_flight]);

            return redirect()->route('passenger.index')->with('status', 'Notification successfully updated.');
        } else if($request->travel_date && is_null($request->return_date)) {
            $notification->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'travel_date' => $request->travel_date,
                'return_date' => null,
                'notification' => $request->notification
            ]);
            $notification->flights()->sync([$request->outbound_flight]);

            return redirect()->route('passenger.index')->with('status', 'Notification successfully updated.');
        } else {
            $notification->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'travel_date' => null,
                'return_date' => $request->return_date,
                'notification' => $request->notification
            ]);
            $notification->flights()->sync([$request->inbound_flight]);

            return redirect()->route('passenger.index')->with('status', 'Notification successfully updated.');
        }
    }

    public function delete($id) {
        $notification = Passenger::where('id', $id)->firstOrFail();
        $notification->flights()->detach();
        $notification->delete();

        return redirect()->route('passenger.index')->with('status', 'Notification successfully deleted.');
    }
}
