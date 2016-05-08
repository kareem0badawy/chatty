<h2>Sign in</h2>
<div class="row">

	<div class="col-lg-6">
		<form class="form-vertical" role="form" method="post" action="{{ route('auth.signin') }}">
				{!! csrf_field() !!}
			<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
				 	<label for="email" class="control-label">Email:</label>
				 	<input type="text" name="email" id="email" class="form-control" value="">
				 @if($errors->has('email'))
						<span class="help-block">{{ $errors->first('email') }}</span>
				 	@endif
			</div>


			<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
				<label for="password" class="control-label">password:</label>
				<input type="password" name="password" id="password"class="form-control" value="">
			@if($errors->has('password'))
						<span class="help-block">{{ $errors->first('password') }}</span>
				 	@endif
			</div>

			<div class="form-group">
				<label>
					<input type="checkbox" name="remember"> Remember Me
				</label>
			</div>

			<button type="submit" class="btn btn-default">Sign in</button>
		
		</form>
	</div>
</div>