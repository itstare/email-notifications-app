<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use Illuminate\Validation\Rule;

class FlightController extends Controller
{
	public function index() {
		$flights = Flight::simplePaginate(25);

		return view('flight.index', compact('flights'));
	}

    public function create() {
    	return view('flight.create');
    }

    public function insert(Request $request) {
    	$rules = [
    		'direction' => ['required', 'string', Rule::in(['outbound', 'inbound'])],
    		'flight_number' => ['required', 'string', 'max:9', 'unique:flights,flight_number'],
    		'dep_airport' => ['required', 'string', 'max:3'],
    		'arv_airport' => ['required', 'string', 'max:3'],
    		'dep_time' => ['required', 'date_format:H:i'],
    		'arv_time' => ['required', 'date_format:H:i']
    	];
    	$request->validate($rules);

    	Flight::create([
    		'direction' => $request->direction,
    		'flight_number' => $request->flight_number,
    		'dep_airport' => strtoupper($request->dep_airport),
    		'arv_airport' => strtoupper($request->arv_airport),
    		'dep_time' => $request->dep_time,
    		'arv_time' => $request->arv_time
    	]);

    	return redirect()->back()->with('status', 'Flight successfully created.');
    }

    public function edit($id) {
    	$flight = Flight::where('id', $id)->firstOrFail();
    	return view('flight.edit', compact('flight'));
    }

    public function update(Request $request, $id) {
    	$rules = [
    		'direction' => ['required', 'string', Rule::in(['outbound', 'inbound'])],
    		'flight_number' => ['required', 'string', 'max:9', Rule::unique('flights')->ignore($id)],
    		'dep_airport' => ['required', 'string', 'max:3'],
    		'arv_airport' => ['required', 'string', 'max:3'],
    		'dep_time' => ['required', 'date_format:H:i'],
    		'arv_time' => ['required', 'date_format:H:i']
    	];
    	$request->validate($rules);

    	$flight = Flight::where('id', $id)->firstOrFail();

    	$flight->update([
    		'direction' => $request->direction,
    		'flight_number' => $request->flight_number,
    		'dep_airport' => strtoupper($request->dep_airport),
    		'arv_airport' => strtoupper($request->arv_airport),
    		'dep_time' => $request->dep_time,
    		'arv_time' => $request->arv_time
    	]);

    	return redirect()->route('flight.index')->with('status', 'Flight successfully updated.');
    }

    public function delete($id) {
    	$flight = Flight::where('id', $id)->firstOrFail();
        $flight->passengers()->detach();
    	$flight->delete();

    	return redirect()->route('flight.index')->with('status', 'Flight successfully deleted.');
    }
}
