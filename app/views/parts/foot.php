	<?php
		if ($this->messages->hasErrors()) {
			?>
				<div id="message-container">
					<?php $this->messages->display(); ?>
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
