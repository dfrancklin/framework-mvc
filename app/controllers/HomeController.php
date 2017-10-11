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
		return $this->dashboard();
	}

	/**
	 * @RequestMap dashboard
	 */
	public function dashboard() {
		$view = $this->factory::create();

		$view->pageTitle = 'Dashboard';
		$view->form = \App\Components\FormComponent::class;

		return $view->render('dashboard');
	}

}
