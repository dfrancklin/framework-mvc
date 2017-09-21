<?php

namespace FW\MVC;

use FW\Interfaces\IController;

abstract class Controller implements IController {

	public function __construct() {
		echo 'Controller';
	}

}

