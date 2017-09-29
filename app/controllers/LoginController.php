<?php

namespace App\Controllers;

use FW\View\IViewFactory;
use FW\Security\ISecurityService;
use FW\Security\IAuthentication;

use App\Interfaces\ILoginService;

/**
 * @Controller
 */
class LoginController implements IAuthentication {

	private $service;

	private $security;

	private $factory;

	public function __construct(ILoginService $service, ISecurityService $security, IViewFactory $factory){
		$this->service = $service;
		$this->factory = $factory;
	}

	/**
	 * @RequestMap /login
	 */
	public function login($returnsTo='') {
		$view = $this->factory::create();

		$view->returnsTo = $returnsTo;

		return $view->render('login/form');
	}

	/**
	 * @RequestMap /authenticate
	 * @RequestMethod POST
	 */
	public function authenticate() {
		($_POST);
	}

	/**
	 * @RequestMap /forbidden
	 */
	public function forbidden($route) {

	}

	/**
	 * @RequestMap /logout
	 */
	public function logout() {

	}

}
