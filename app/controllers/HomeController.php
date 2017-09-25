<?php

namespace App\Controllers;

use \FW\MVC\Controller;
use \FW\MVC\View;
use \App\Interfaces\IHomeService;

/**
 * @Controller
 * @Route /
 * @Authenticate
 */
class HomeController extends Controller {

	private $service;

	public function __construct(IHomeService $service) {
		parent::__construct();

		$this->service = $service;
	}

	public function index() {
		return 'Home page!';
	}

	/**
	 * @RequestMap products
	 * @RequestMethod [GET, PUT, POST, PATCH]
	 */
	public function products() {
		return 'Products page!';
	}

	/**
	 * @RequestMap save
	 * @RequestMethod POST
	 */
	public function save() {
		return 'Saving!';
	}

	/**
	 * @RequestMap /news/{year}/{month}/{day}/{slug}
	 */
	public function newsByDateAndSlug($year, $month, $day, $slug) {
		return new View();
	}

}
