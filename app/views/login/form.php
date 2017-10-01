<div id="container">
	<div id="form">
		<h1>Login</h1>

		<form action="/authenticate" method="POST">
			<input type="hidden" name="returns-to" value="<?=$returnsTo?>">

			<div class="form-group">
				<label for="email">E-mail:</label>
				<input type="email" name="email" id="email" class=form-control required autofocus value="dfrancklin23@gmail.com">
			</div>

			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" class=form-control required value="123">
			</div>

			<div class="form-group">
				<input type="checkbox" name="remember-me" id="remember-me">
				<label for="remember-me">Remember Me</label>
			</div>

			<button type="submit" class="btn">Submit</button>
		</form>
	</div>
</div>
