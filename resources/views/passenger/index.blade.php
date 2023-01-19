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
		<div class="col-md-3"><h5>Name</h5></div>
		<div class="col-md-3"><h5>Travel Date</h5></div>
		<div class="col-md-3"><h5>Return Date</h5></div>
		<div class="col-md-3"><h5>Nav</h5></div>
	</div>

	@foreach($notifications as $notification)
		<div class="row my-3">
			<div class="col-md-3">{{ $notification->fullName() }}</div>
			<div class="col-md-3">{{ $notification->travelDateString() }}</div>
			<div class="col-md-3">{{ $notification->returnDateString() }}</div>
			<div class="col-md-3">
				<a href="{{ route('passenger.view', $notification->id) }}" class="btn btn-sm btn-primary">View</a>
				<a href="{{ route('passenger.edit', $notification->id) }}" class="btn btn-sm btn-warning">Edit</a>
				<a href="{{ route('passenger.delete', $notification->id) }}" class="btn btn-sm btn-danger">Delete</a>
			</div>
		</div>
		<hr>
	@endforeach

	<div class="mt-5">
	{{ $notifications->links() }}
	</div>
</div>
@endsection