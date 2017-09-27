<div class="row">
	<div class="col-md-4 col-md-offset-4">
	<h1>Sign up<h1>
	@if(count($erros) > 0 )
		<div class="alert alert-danger">
			@foreach($erros->all() as $error)
				<p>{{ $error }}</p>
			@endforeach()
		</div>
	@endif
	<form action="" method="post">
		<div class="form-group">
			<label for="name">Name</label>
		 	<input type="text" id="name" name="name">
		</div>
		<div class="form-group">
			<label for="email">E-mail</label>
		 	<input type="text" id="email" name="email">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
		 	<input type="password" id="password" name="password">
		</div>
		<button type="submit">Sign Up</button>
	</form>
	</div>	
</div>