<?php

namespace App\Controllers;

use \App\Interfaces\IHomeService;

/**
 * @Controller
 * @Route /
 * @Authenticate
 * @Roles [ADMIN,USER]
 */
class HomeController {

	private $service;

	public function __construct(IHomeService $service) {
		$this->service = $service;
	}

	public function index() {
		return 'Home page!';
	}

	/**
	 * @RequestMap products
	 * @RequestMethod [GET, PUT, POST, PATCH]
	 * @Roles [ADMIN]
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
		return 'News page!';
	}

}
