@extends('templates.default')


@section('content')

	<div class="row">
		<div class="col-lg-5">
			@include('user.partials.userblock')
			<hr>

			@if(!$statuses->count())
				<p>{{ $user->getFirstNameOrUsername() }} hasn't posted anything yet.</p>
			@else
				@foreach($statuses as $status)
						<div class="media">
								<a class="pull-left" href="{{ route('profile.index',
								 ['username' => $status->user->username])}}">
									<img style="border-radius: 50%" class="media-object" 
									src="{{ $status->user->getAvatarUrl() }}"
									 title="{{ $status->user->getFirstNameOrUsername() }}">
								</a>
								<div class="media-body">
									<h5 class="media-heading"><a href="{{ route('profile.index',
								 ['username' => $status->user->username])}}">
								 {{ $status->user->getNameOrUsername() }}
								 </a></h5>
									<p>{{ $status->body }}</p>
									<ul class="list-inline">
										<li>{{ $status->created_at->diffForHumans() }}</li>
										<li><a href="">Like</a></li>
										<li>6 Likes</li>
									</ul>
									
							@foreach($status->replies as $reply)
								<div class="media">
									<a class="pull-left" href="{{ route('profile.index',
									 	['username' => $reply->user->username])}}">
										<img style="border-radius: 50%" class="media-object" 
										src="{{ $status->user->getAvatarUrl() }}"
										 title="{{ $status->user->getFirstNameOrUsername() }}">
									</a>
								<div class="media-body">
									<h5 class="media-heading"><a href="{{ route('profile.index',
									 	['username' => $reply->user->username])}}">
										{{ $reply->user->getNameOrUsername() }}
										</a>
									</h5>
									<p> {{ $reply->body }} </p>
									<ul class="list-inline">
										<li>{{ $reply->created_at->diffForHumans() }}</li>
										<li style="font-size: 25px;"><a href="" style="color: red">❤</a></li>
										<li>4 Likes</li>
									</ul>
								</div>
							</div>
							@endforeach
							<form role="form" action="{{ route('status.reply', ['statusId' => $status->id] )}}" method="post">
								<div class="form-group{{ $errors->has("reply-{$status->id}") ? 'has-error' : '' }}">
									<textarea name="reply-{{ $status->id }}" class="form-control"
										 rows="2" placeholder="Reply to this status"></textarea>
											@if($errors->has("reply-{$status->id}"))
												<span class="help-block">{{ $errors->first("reply-{$status->id}") }}</span>
				 							@endif
								</div>
								<input type="submit"  value="Reply" class="btn btn-default btn-sm">
								<hr>
								{{ csrf_field() }}
							</form>
						</div>
					</div>
				@endforeach
			@endif
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

