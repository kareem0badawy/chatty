@extends('templates.default')


@section('content')
<h3 style="color: #286090">Your search for "{{ Request::input('query') }}" </h3>

	@if (!$users->count())
		<p class="label label-warning" style="font-size:15px ">
		No Resultes Found, Sorry. !
		</p>
	@else

		<div class="row">
			<div class="col-lg-12">
				@foreach ($users as $user)
					@include('user.partials.userblock')
				@endforeach

			</div>
		</div>
	@endif
@stop
