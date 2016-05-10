@extends('templates.default')


@section('content')

	<div class="row">
		<div class="col-lg-6">
			<h3>Your Friends</h3>
			
			@if(!$friends->count())
				<p>You have has not friends.</p>
			@else
				@foreach($friends as $user)
					@include('user/partials/userblock')
				@endforeach
			@endif
			
		</div>
		<div class="col-lg-6">
			<h4>Friends Requests</h4>
			<hr>
			@if (!$requests->count())
				<p>You have no friends requeste.</p>
			@else
				@foreach($requests as $user)
					@include('user.partials.userblock')
				@endforeach
			@endif
		</div>
		
	</div>
     
@stop
