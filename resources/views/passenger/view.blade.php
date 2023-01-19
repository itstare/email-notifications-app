@extends('layouts.app')
@section('content')
<div class="container w-50">
	<div class="card">
	  <div class="card-body">
	    <h2>{{ $notification->fullName() }}</h2>
	    <div class="row mt-3">
	    	<div class="col-md-6">
	    		<h4>Travel Date</h4>
	    	</div>
	    	<div class="col-md-6">
	    		<h4>Return Date</h4>
	    	</div>
	    </div>
	    <div class="row mt-2">
	    	<div class="col-md-6">
	    		<span class="badge bg-primary p-2">{{ $notification->travelDate() }}</span>
	    		<span class="badge bg-success p-2">{{ $notification->outboundFlight() }}</span>
	    	</div>
	    	<div class="col-md-6">
	    		<span class="badge bg-primary p-2">{{ $notification->returnDate() }}</span>
	    		<span class="badge bg-success p-2">{{ $notification->inboundFlight() }}</span>
	    	</div>
	    </div>
	    <div class="row mt-3">
	    	<h4>Notification</h4>
	    	<p>{{ $notification->notification }}</p>
	    </div>
	    <div class="row mt-3">
	    	<div class="col-md-6">
	    		<a href="{{ route('passenger.edit', $notification->id) }}" class="btn btn-warning">Edit</a>
	    	</div>
	    	<div class="col-md-6 text-end">
	    		<a href="{{ route('passenger.delete', $notification->id) }}" class="btn btn-danger">Delete</a>
	    	</div>
	    </div>
	  </div>
	</div>
</div>
@endsection