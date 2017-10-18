<?php

namespace App\Controllers;

use FW\Core\Router;
use FW\Core\FlashMessages;
use FW\View\IViewFactory;

use App\Interfaces\IProductService;
use App\Components\FormComponent;

/**
 * @Controller
 * @Route /products
 * @Authenticate
 */
class ProductsController {

	private $factory;

	private $service;

	private $message;

	public function __construct(IViewFactory $factory, IProductService $service) {
		$this->factory = $factory;
		$this->service = $service;
		$this->message = FlashMessages::getInstance();
	}

	public function products() {
		$quantity = 10;
		$page = $_GET['page'] ?? 1;
		$offset = ($page - 1) * $quantity;
		$products = $this->service->page($offset, $quantity);

		if (empty($products) && $page != 1) {
			Router::redirect('/products');
		}

		$view = $this->factory::create();
		$view->pageTitle = 'Products';
		$view->products = $products;

		return $view->render('products/home');
	}

	/**
	 * @RequestMap /form/{id}
	 */
	public function edit(int $id) {
		$product = $this->service->byId($id);

		if ($product) {
			$this->form($product);
		} else {
			$this->message->error('No product with the ID ' . $id . ' was found!');
			Router::redirect('/products');
		}
	}

	/**
	 * @RequestMap /form
	 */
	public function create() {
		return $this->form();
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

	private function form($product = null) {
		$view = $this->factory::create();

		$view->pageTitle = 'Products';
		$view->product = $product;
		$view->form = new FormComponent;

		return $view->render('products/form');
	}

}
