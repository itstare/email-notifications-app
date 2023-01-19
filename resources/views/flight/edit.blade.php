@extends('layouts.app')
@section('content')
<div class="container w-50">
	<div class="card">
	  <div class="card-body">
	    <h2>Edit Flight | {{ $flight->flight_number }}</h2>
	    <form action="{{ route('flight.update', $flight->id) }}" method="POST">
	    	<div class="form-group">
	    		<label for="direction">Direction</label>
	    		<select name="direction" class="form-control @error('direction') is-invalid @enderror">
	    			<option value="outbound">Outbound</option>
	    			<option value="inbound" @if($flight->direction === 'inbound') selected @endif>Inbound</option>
	    		</select>

	    		@error('direction')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
	    	</div>

	    	<div class="form-group mt-2">
	    		<label for="flight_number">Flight Number</label>
	    		<input type="text" name="flight_number" class="form-control @error('flight_number') is-invalid @enderror" value="{{ $flight->flight_number }}" required>

	    		@error('flight_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
	    	</div>

	    	<div class="form-group mt-2">
	    		<div class="row">
	    			<div class="col-md-6">
	    				<label for="dep_airport">Departure Airport</label>
	    				<input type="text" name="dep_airport" class="form-control @error('dep_airport') is-invalid @enderror" value="{{ $flight->dep_airport }}" required>

	    				@error('dep_airport')
                    		<span class="invalid-feedback" role="alert">
                        		<strong>{{ $message }}</strong>
                    		</span>
                		@enderror
	    			</div>
	    			<div class="col-md-6">
	    				<label for="arv_airport">Arrival Airport</label>
	    				<input type="text" name="arv_airport" class="form-control @error('arv_airport') is-invalid @enderror" value="{{ $flight->arv_airport }}" required>

	    				@error('arv_airport')
                    		<span class="invalid-feedback" role="alert">
                        		<strong>{{ $message }}</strong>
                    		</span>
                		@enderror
	    			</div>
	    		</div>
	    	</div>

	    	<div class="form-group mt-2">
	    		<div class="row">
	    			<div class="col-md-6">
	    				<label for="dep_time">Departure Time</label>
	    				<input type="time" name="dep_time" class="form-control @error('dep_time') is-invalid @enderror" value="{{ $flight->departureTime() }}" required>

	    				@error('dep_time')
                    		<span class="invalid-feedback" role="alert">
                        		<strong>{{ $message }}</strong>
                    		</span>
                		@enderror
	    			</div>
	    			<div class="col-md-6">
	    				<label for="arv_time">Arrival Time</label>
	    				<input type="time" name="arv_time" class="form-control @error('arv_time') is-invalid @enderror" value="{{ $flight->arrivalTime() }}" required>

	    				@error('arv_time')
                    		<span class="invalid-feedback" role="alert">
                        		<strong>{{ $message }}</strong>
                    		</span>
                		@enderror
	    			</div>
	    		</div>
	    	</div>

	    	<div class="row">
	    		<div class="col-md-6">
	    			<button type="submit" class="btn btn-primary mt-3">Update</button>
	    		</div>
	    		<div class="col-md-6 text-end">
	    			<a href="{{ route('flight.delete', $flight->id) }}" class="btn btn-danger mt-3">Delete</a>
	    		</div>
	    	</div>
	    	@csrf
	    </form>
	  </div>
	</div>
</div>
@endsection