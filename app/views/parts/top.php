<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<button class="navbar-toggler mr-3">
		<span class="navbar-toggler-icon"></span>
	</button>

	<a class="navbar-brand mr-auto" href="#">Navbar</a>

	<div class="dropdown">
		<button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<?php echo $this->security->getUserProfile()->getName(); ?>
		</button>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			<a class="dropdown-item" href="#">Profile</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="/logout">Log out</a>
		</div>
	</div>
</nav>
