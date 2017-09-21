<?php

namespace App\Controllers;

use \FW\MVC\Controller;
use \App\Interfaces\IHomeService;

/**
 * Route home
 * Inject ???
 */
class HomeController extends Controller {

	public function __construct(IHomeService $service) {
		parent::__construct();
	}

	public function index() {
		return 'Home page!';
	}

}
