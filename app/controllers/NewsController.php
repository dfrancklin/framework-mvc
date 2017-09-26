<?php

namespace App\Controllers;

use \FW\MVC\View;

/**
 * @Controller
 * @Route /news
 * @Authenticate
 */
class NewsController {

	private $view;

	public function __construct() {
		$this->view = new View();
	}

	public function news() {
		$this->view->pageTitle = 'News';

		$this->view->newsList = [
			(object) [
				'id' => 1,
				'title' => 'News #1',
				'text' => 'lipsum'
			],
			(object) [
				'id' => 2,
				'title' => 'News #2',
				'text' => 'lipsum'
			],
		];

		return $this->view->render('news/home');
	}

	/**
	 * @RequestMap /{id}
	 */
	public function newById($id) {
		return 'News ' . $id . ' page!';
	}

	/**
	 * @RequestMethod POST
	 */
	public function save() {
		return 'Saving news!';
	}

	/**
	 * @RequestMap /{id}
 * @RequestMethod DELETE
	 */
	public function delete($id) {
		return 'Deleting news ' . $id . '!';
	}

}
