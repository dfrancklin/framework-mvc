<?php

namespace FW\MVC;

use FW\Interfaces\IRepository;

abstract class Repository implements IRepository {

	public function __construct() {
		echo 'Repository';
	}

}

