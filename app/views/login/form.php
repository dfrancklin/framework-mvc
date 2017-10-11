<div id="form">
	<h1 class="text-center"><?=$pageTitle?></h1>

	<form action="/authenticate" method="POST">
		<input type="hidden" name="returns-to" value="<?=$returnsTo?>">

		<div class="form-group">
			<label class="sr-only" for="email">E-mail:</label>

			<div class="input-group input-group-lg">
				<span class="input-group-addon bg-dark">
					<span class="material-icons">account_circle</span>
				</span>

				<input type="email" name="email" id="email" class=form-control required autofocus value="dfrancklin23@gmail.com">
			</div>

			<label class="sr-only" for="password">Password:</label>

			<div class="input-group input-group-lg">
				<div class="input-group-addon bg-dark">
					<span class="material-icons">lock</span>
				</div>

				<input type="password" name="password" id="password" class=form-control required value="123">
			</div>
		</div>

		<div class="form-group">
			<input type="checkbox" name="remember-me" id="remember-me">
			<label for="remember-me">Remember Me</label>
		</div>

		<button type="submit" class="btn btn-dark btn-lg btn-block">
			Submit <span class="material-icons">keyboard_return</span>
		</button>
	</form>
</div>
