	<?php
		if ($this->messages->hasMessages()) {
			?>
				<div id="messages-wrapper">
					<div id="messages-container">
						<?php $this->messages->display(); ?>
					</div>
				</div>
			<?php
		}

		if(isset($scripts)) {
			foreach ($scripts as $script) {
				?><script src="<?=$script?>"></script><?php
			}
		}
	?>
</body>
</html>
