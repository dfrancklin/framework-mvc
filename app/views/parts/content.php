<div class="container-fluid">
	<div class="row">
		<aside class="col col-lg-3">
			<h3>Menu<?php echo $this->security->isAuthenticated() ? ' Authenticated' : ''; ?></h3>
		</aside>

		<div id="main" class="col">
			<!-- content -->
		</div>
	</div>
</div>
