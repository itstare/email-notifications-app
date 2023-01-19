@extends('layouts.app')
@section('content')
<div class="container">
	@if(session('status'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
  		{{ session()->get('status') }}
  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@endif
	
	<div class="row">
		<div class="col-md-3"><h5>Flight No.</h5></div>
		<div class="col-md-3"><h5>Direction</h5></div>
		<div class="col-md-3"><h5>Dep/Arv Airport</h5></div>
		<div class="col-md-3"><h5>Dep/Arv Time</h5></div>
	</div>

	@foreach($flights as $flight)
	<a href="{{ route('flight.edit', $flight->id) }}" class="text-decoration-none text-body">
		<div class="row my-2">
			<div class="col-md-3">{{ $flight->flight_number }}</div>
			<div class="col-md-3">{{ $flight->direction }}</div>
			<div class="col-md-3">{{ $flight->airport() }}</div>
			<div class="col-md-3">{{ $flight->time() }}</div>
		</div>
	</a>
	<hr>
	@endforeach

	<div class="mt-5">
	{{ $flights->links() }}
	</div>
</div>
@endsection