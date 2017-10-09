<?php

namespace App\Controllers;

use FW\View\IViewFactory;

/**
 * @Controller
 * @Route /products
 * @Authenticate
 */
class ProductsController {

	private $factory;

	public function __construct(IViewFactory $factory) {
		$this->factory = $factory;
	}

	public function products() {
		$view = $this->factory::create('template');

		$view->pageTitle = 'Products';

		$newsList = [];

		foreach (range(1, 10) as $id) {
			$newsList[] = (object) [
				'id' => $id,
				'title' => 'Products #' . $id,
				'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam accumsan, velit id venenatis blandit, dui sem mattis nulla, non varius nunc purus in nisl. Sed malesuada egestas rutrum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean nec porta nunc, id posuere tortor. Duis vitae mollis sapien, nec egestas nisi. Pellentesque sed consequat mi. Quisque sit amet maximus tortor.'
			];
		}

		$view->newsList = $newsList;

		return $view->render('products/home');
	}

	/**
	 * @RequestMap /{id}
	 */
	public function newById($id) {
		return 'products ' . $id . ' page!';
	}

	/**
	 * @RequestMethod POST
	 */
	public function save() {
		return 'Saving products!';
	}

	/**
	 * @RequestMap /{id}
	 * @RequestMethod DELETE
	 */
	public function delete($id) {
		return 'Deleting products ' . $id . '!';
	}

}
