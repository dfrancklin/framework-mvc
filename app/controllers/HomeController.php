<?php

namespace App\Controllers;

use \FW\MVC\Controller;
use \App\Interfaces\IHomeService;

/**
 * @Controller
 * @Route /
 * @Inject ???
 */
class HomeController extends Controller {

	public function __construct(IHomeService $service) {
		parent::__construct();
	}

	/**
	 * @RequestMap /
	 */
	public function index() {
		return 'Home page!';
	}

}
