<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<button class="navbar-toggler mr-3" type="button" data-toggle="collapse" data-target="#nav-toggleable-md">
		<span class="material-icons">menu</span>
	</button>

	<a class="navbar-brand mr-auto" href="/">Project</a>

	<div class="dropdown">
		<button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $this->security->getUserProfile()->getName(); ?></button>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			<a class="dropdown-item" href="/profile">Profile</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="/logout">Log out</a>
		</div>
	</div>
</nav>
