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
		$view = $this->factory::create();

		$view->pageTitle = 'Products';

		return $view->render('products/home');
	}

	/**
	 * @RequestMap /form/{id}
	 */
	public function form(int $id) {
		$view = $this->factory::create();

		$view->pageTitle = 'Products';
		$view->id = $id;

		return $view->render('products/home');
	}

	/**
	 * @RequestMap /{id}
	 */
	public function newById(int $id) {
		$view = $this->factory::create();

		$view->pageTitle = 'Products';
		$view->id = 'none';

		return $view->render('products/home');
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
