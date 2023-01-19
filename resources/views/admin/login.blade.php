@extends('layouts.app')
@section('content')
<div class="container w-50">
	<div class="card">
		<div class="card-body">
			<h2>Admin Login</h2>
			<form action="{{ route('admin.create-session') }}" method="POST">
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>

					@error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
				</div>

				<button type="submit" class="btn btn-primary mt-3">Submit</button>
				@csrf
			</form>
		</div>
	</div>
</div>
@endsection