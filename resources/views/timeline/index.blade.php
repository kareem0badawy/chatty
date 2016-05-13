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
									src="{{ $status->user->getAvatarUrl() }}" title="{{ $status->user->getFirstNameOrUsername() }}">
								</a>
								<div class="media-body">
									<h5 class="media-heading"><a href="{{ route('profile.index',
								 ['username' => $status->user->username])}}">
								 {{ $status->user->getFirstNameOrUsername() }}
								 </a></h5>
									<p>{{ $status->body }}</p>
									<ul class="list-inline">
										<li>{{ $status->created_at->diffForHumans() }}</li>
										<li><a href="">Like</a></li>
										<li>6 Likes</li>
									</ul>
									
							<!--div class="media">
								<a class="pull-left" href="">
									<img class="media-object" src="">
								</a>
								<div class="media-body">
									<h5 class="media-heading"><a href="">Billy</a></h5>
									<p>Yes, it is lovely!</p>
									<ul class="list-inline">
										<li>8 days ago.</li>
										<li><a href="">Like</a></li>
										<li>4 Likes</li>
									</ul>
								</div>
							</div-->

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