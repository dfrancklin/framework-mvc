<?php

namespace App\Repositories;

use App\Interfaces\IProductRepository;
use App\Models\Product;

/**
 * @Repository
 */
class ProductRepository implements IProductRepository {

	private static $table;

	public function __construct() {
		$this->loadTable();
	}

	public function all() {
		return self::$table;
	}

	public function page($offset, $quantity) {
		$page = [];

		for ($i = $offset; isset(self::$table[$i]) && $quantity; $i++, --$quantity) {
			$page[] = self::$table[$i];
		}

		return $page;
	}

	public function byId($id) {
		return self::$table[$id - 1];
	}

	public function save($product) {
		return;
	}

	public function delete($id) {
		return;
	}

	private function loadTable() {
		$json = file_get_contents(__DIR__ . '/../models/Product.data.json');
		$list = json_decode($json);

		self::$table = [];

		foreach ($list as $p) {
			self:: $table[] = $this->createProduct($p);
		}
	}

	private function createProduct($p) {
		$product = new Product;

		$properties = ['id', 'name', 'description', 'picture', 'price', 'quantity'];

		foreach ($properties as $property) {
			$product->{$property} = $p->{$property};
		}

		return $product;
	}

}
