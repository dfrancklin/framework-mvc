<?php

namespace App\Controllers;

use FW\Core\Router;
use FW\Core\FlashMessages;
use FW\View\IViewFactory;
use FW\Security\ISecurityService;
use FW\Security\IAuthentication;
use FW\Security\UserProfile;

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
		$this->security = $security;
		$this->factory = $factory;
		$this->message = FlashMessages::getInstance();
	}

	/**
	 * @RequestMap /login
	 */
	public function login($returnsTo='') {
		$view = $this->factory::create('login-template');
		
		$view->styles = ['app/resources/css/login.css'];
		$view->returnsTo = $returnsTo;

		return $view->render('login/form');
	}

	/**
	 * @RequestMap /authenticate
	 * @RequestMethod POST
	 */
	public function authenticate() {
		$user = $this->service->authenticate($_POST['email'], $_POST['password']);
		
		if (!$user) {
			$this->message->error('User does not exists or invalid password');
			Router::redirect($_POST['returns-to']);
		}
		
		$this->security->authenticate(new UserProfile($user->email, $user->name, $user->roles));
		
		if (isset($_POST['returns-to']) && !empty(trim($_POST['returns-to']))) {
			Router::redirect($_POST['returns-to']);
		} else {
			Router::redirect('/');
		}
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
		$this->security->logout();
		Router::redirect('/');
	}

}
