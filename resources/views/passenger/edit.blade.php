@extends('layouts.app')
@section('content')
<div class="container w-50">
	<div class="card">
	  <div class="card-body">
	    <h2>Edit Notification | {{ $notification->fullName() }}</h2>
	    <form action="{{ route('passenger.update', $notification->id) }}" method="POST">
	    	<div class="form-group mt-2">
	    		<div class="row">
	    			<div class="col-md-6">
	    				<label for="first_name">First Name</label>
	    				<input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ $notification->first_name }}" required>

	    				@error('first_name')
                    		<span class="invalid-feedback" role="alert">
                        		<strong>{{ $message }}</strong>
                    		</span>
                		@enderror
	    			</div>
	    			<div class="col-md-6">
	    				<label for="last_name">Last Name</label>
	    				<input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ $notification->last_name }}" required>

	    				@error('last_name')
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
	    				<label for="travel_date">Travel Date</label>
	    				<input type="date" name="travel_date" class="form-control @error('travel_date') is-invalid @enderror" value="{{ $notification->travel_date }}">

	    				@error('travel_date')
                    		<span class="invalid-feedback" role="alert">
                        		<strong>{{ $message }}</strong>
                    		</span>
                		@enderror
	    			</div>
	    			<div class="col-md-6">
	    				<label for="outbound_flight">Outbound Flight</label>
	    				<select name="outbound_flight" class="form-control @error('outbound_flight') is-invalid @enderror">
	    					<option value=""></option>
	    					@foreach($outboundFlights as $flight)
	    					<option value="{{ $flight->id }}" @if($flightOutbound == $flight->id) selected @endif>{{ $flight->flightString() }}</option>
	    					@endforeach
	    				</select>

	    				@error('outbound_flight')
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
	    				<label for="return_date">Return Date</label>
	    				<input type="date" name="return_date" class="form-control @error('return_date') is-invalid @enderror" value="{{ $notification->return_date }}">

	    				@error('return_date')
                    		<span class="invalid-feedback" role="alert">
                        		<strong>{{ $message }}</strong>
                    		</span>
                		@enderror
	    			</div>
	    			<div class="col-md-6">
	    				<label for="inbound_flight">Inbound Flight</label>
	    				<select name="inbound_flight" class="form-control @error('inbound_flight') is-invalid @enderror">
	    					<option value=""></option>
	    					@foreach($inboundFlights as $flight)
	    					<option value="{{ $flight->id }}" @if($flightInbound == $flight->id) selected @endif>{{ $flight->flightString() }}</option>
	    					@endforeach
	    				</select>

	    				@error('inbound_flight')
                    		<span class="invalid-feedback" role="alert">
                        		<strong>{{ $message }}</strong>
                    		</span>
                		@enderror
	    			</div>
	    		</div>
	    	</div>

	    	<div class="form-group mt-2">
	    		<label for="notification">Notification</label>
	    		<textarea name="notification" class="form-control @error('notification') is-invalid @enderror" rows="5" required>{{ $notification->notification }}</textarea>
	    	</div>

	    	<button type="submit" class="btn btn-primary mt-3">Update</button>
	    	@csrf
	    </form>
	  </div>
	</div>
</div>
@endsection