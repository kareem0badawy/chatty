@extends('templates.default')


@section('content')

	<div class="row">
		<div class="col-lg-5">
			@include('user.partials.userblock')
			<hr>
		</div>

		<div class="col-lg-4 col-lg-offset-3">
			
		@if (Auth::user()->hasFriendRequestesPending($user))
				<p>Witing fo {{ $user->getNameOrUsername() }} to accept your request.</p>

		@elseif( Auth::user()->hasFriendRequestesReceived($user))
				<a href="{{ route('friends.accept', ['username' => $user->username]) }}" class="btn btn-primary">Accept Friend Request</a>

		@elseif(Auth::user()->isFriendWith($user))
				<p>You and  {{ $user->getNameOrUsername() }} are Friends.</p>
		@elseif(Auth::user()->id !== $user->id)
				<a href="{{ route('friends.add', ['username' => $user->username]) }}" class="btn btn-primary">Add as friend</a>
		@endif

			<br>
			<br>
			<h4 class="label label-default" style="font-size: 18px;">
			 		Friends {{ $user->getFirstNameOrUsername() }} .
			 </h4>

				@if(!$user->friends()->count())

					<p>{{ $user->getFirstNameOrUsername() }} has not friends.</p>
				@else
					@foreach($user->friends() as $user)
						@include('user.partials.userblock')
					@endforeach
					
				@endif
	</div>

@stop

