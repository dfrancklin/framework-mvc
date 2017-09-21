<?php

namespace FW\MVC;

use FW\Interfaces\IView;

abstract class View implements IView {

	public function __construct() {
		echo 'View';
	}

}

