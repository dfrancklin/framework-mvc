<?php

namespace App\Controllers;

use \FW\MVC\View;

/**
 * @Controller
 * @Route /news
 */
class NewsController {

	private $view;

	public function __construct() {
		$this->view = new View();
	}

	public function news() {
		$this->view->pageTitle = 'News';

		$newsList = [];

		foreach (range(1, 10) as $id) {
			$newsList[] = (object) [
				'id' => $id,
				'title' => 'News #' . $id,
				'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam accumsan, velit id venenatis blandit, dui sem mattis nulla, non varius nunc purus in nisl. Sed malesuada egestas rutrum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean nec porta nunc, id posuere tortor. Duis vitae mollis sapien, nec egestas nisi. Pellentesque sed consequat mi. Quisque sit amet maximus tortor.'
			];
		}

		$this->view->newsList = $newsList;

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
	 * @Authenticate
	 * @Roles [ADMIN]
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
