<?php

namespace App\Controllers;

use \App\Interfaces\IHomeService;
use \FW\View\IViewFactory;

/**
 * @Controller
 * @Route /
 * @Authenticate
 * @Roles [ADMIN,USER]
 */
class HomeController {

	private $service;
	
	private $factory;

	public function __construct(IHomeService $service, IViewFactory $factory) {
		$this->service = $service;
		$this->factory = $factory;
	}

	public function index() {
		return 'Home page!';
	}

	/**
	 * @RequestMap dashboard
	 */
	public function dashboard() {
		$view = $this->factory::create();
		
		$view->pageTitle = 'Dashboard';
		
		return $view->render('dashboard');
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
