<h2>Update your profile</h2>
<div class="row">
	<div class="col-lg-6">
		<form class="form-vertical" role="form" method="post" action="{{ route('profile.edit')}}">
				{!! csrf_field() !!}
			<div class="row">
				<div class="col-lg-6 {{ $errors->has('first_name') ? 'has-error' : ''}}">
					<div class="form-group">
					 	<label for="first_name" class="control-label">First name :</label>
					 	<input type="text" name="first_name" id="first_name" class="form-control" value="{{ Request::old('first_name') ?: Auth::user()->first_name }}">
					 	@if($errors->has('first_name'))
							<span class="help-block">{{ $errors->first('first_name') }}</span>
				 		@endif 	
					</div>
				</div>

				<div class="col-lg-6 {{ $errors->has('last_name') ? 'has-error' : ''}}">
					<div class="form-group">
						<label for="last_name" class="control-label">Last name :</label>
						<input type="text" name="last_name" id="last_name"class="form-control" 
						value="{{ Request::old('last_name') ?: Auth::user()->last_name }}"> 
						@if($errors->has('last_name'))
							<span class="help-block">{{ $errors->first('last_name') }}</span>
				 		@endif
					</div>
				</div>
			</div>

				<div class="form-group {{ $errors->has('location') ? 'has-error' : ''}}">
					<label for="location" class="control-label">Location :</label>
					<input type="text" name="location" id="location" class="form-control" 
					value="{{ Request::old('location') ?: Auth::user()->location }}">
					@if($errors->has('location'))
						<span class="help-block">{{ $errors->first('location') }}</span>
				 	@endif 
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-success">Update</button>
				</div>
		</form>
	</div>
</div>