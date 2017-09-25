<?php

namespace App\Controllers;

use \FW\MVC\View;

/**
 * @Controller
 * @Route /news
 * @Authenticate
 */
class NewsController {
 
	public function news() {
		return 'Home page!';
	}

	/**
	 * @RequestMap /{id}
	 */
	public function newById($id) {
		return 'Products page!';
	}

	/**
	 * @RequestMethod POST
	 */
	public function save() {
		return 'Saving!';
	}

	/**
	 * @RequestMap /{id}
 * @RequestMethod DELETE
	 */
	public function delete($id) {
		return new View();
	}

}