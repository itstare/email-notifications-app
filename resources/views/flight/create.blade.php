@extends('layouts.app')
@section('content')
<div class="container w-50">
	@if(session('status'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
  		{{ session()->get('status') }}
  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@endif

	<div class="card">
	  <div class="card-body">
	    <h2>Create Flight</h2>
	    <form action="{{ route('flight.insert') }}" method="POST">
	    	<div class="form-group">
	    		<label for="direction">Direction</label>
	    		<select name="direction" class="form-control @error('direction') is-invalid @enderror">
	    			<option value="outbound">Outbound</option>
	    			<option value="inbound" @if(old('direction') === 'inbound') selected @endif>Inbound</option>
	    		</select>

	    		@error('direction')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
	    	</div>

	    	<div class="form-group mt-2">
	    		<label for="flight_number">Flight Number</label>
	    		<input type="text" name="flight_number" class="form-control @error('flight_number') is-invalid @enderror" value="{{ old('flight_number') }}" required>

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
	    				<input type="text" name="dep_airport" class="form-control @error('dep_airport') is-invalid @enderror" value="{{ old('dep_airport') }}" required>

	    				@error('dep_airport')
                    		<span class="invalid-feedback" role="alert">
                        		<strong>{{ $message }}</strong>
                    		</span>
                		@enderror
	    			</div>
	    			<div class="col-md-6">
	    				<label for="arv_airport">Arrival Airport</label>
	    				<input type="text" name="arv_airport" class="form-control @error('arv_airport') is-invalid @enderror" value="{{ old('arv_airport') }}" required>

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
	    				<input type="time" name="dep_time" class="form-control @error('dep_time') is-invalid @enderror" value="{{ old('dep_time') }}" required>

	    				@error('dep_time')
                    		<span class="invalid-feedback" role="alert">
                        		<strong>{{ $message }}</strong>
                    		</span>
                		@enderror
	    			</div>
	    			<div class="col-md-6">
	    				<label for="arv_time">Arrival Time</label>
	    				<input type="time" name="arv_time" class="form-control @error('arv_time') is-invalid @enderror" value="{{ old('arv_time') }}" required>

	    				@error('arv_time')
                    		<span class="invalid-feedback" role="alert">
                        		<strong>{{ $message }}</strong>
                    		</span>
                		@enderror
	    			</div>
	    		</div>
	    	</div>

	    	<button type="submit" class="btn btn-primary mt-3">Create</button>
	    	@csrf
	    </form>
	  </div>
	</div>
</div>
@endsection