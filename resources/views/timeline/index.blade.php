@extends('templates.default')

@section('content')

	<div class="row">
		<div class="col-lg-6">
			<form role="form" action="{{ route('status.post') }}" method="post">
					{!! csrf_field() !!}
				<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
					<textarea placeholder="What's up {{ Auth::user()->getFirstNameOrUsername() }}..?"
						name="status" class="form-control"  rows="2"></textarea>
						@if($errors->has('status'))
							<span class="help-block">{{ $errors->first('status') }}</span>
				 		@endif 	
				</div>
				<button type="submit" class="btn btn-success">Update Status</button>
			</form>
			<hr>
		</div>
	</div>

	
	<div class="row">
		<div class="col-lg-5">
			@if(!$statuses->count())
				<p>There's nothing in your timeline, yet.</p>
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

										@if($status->user->id !== Auth::user()->id)
										<li>
											<a href="{{ route('status.like', [
											'statusId' => $status->id]) }}">Like</a>
										</li>
										<li>4 Likes</li>
										@endif
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
										@if($reply->user->id !== Auth::user()->id)
										<li>
											<a href="{{ route('status.like', [
											'statusId'=> $reply->id]) }}">Like</a>
										</li>
										<li>4 Likes</li>
										@endif
										
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
					{!! $statuses->render() !!}
			@endif
		</div>
	</div>
@stop