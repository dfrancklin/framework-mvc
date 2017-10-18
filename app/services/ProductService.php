<?php

namespace App\Services;

use App\Interfaces\IProductService;
use App\Interfaces\IProductRepository;

/**
 * @Service
 */
class ProductService implements IProductService {

	private $repository;

	public function __construct(IProductRepository $repository) {
		$this->repository = $repository;
	}

	public function all() {
		return $this->repository->all();
	}

	public function page($offset, $quantity) {
		return $this->repository->page($offset, $quantity);
	}

	public function byId($id) {
		return $this->repository->byId($id);
	}

	public function save($product) {
		return $this->repository->save($product);
	}

	public function delete($id) {
		return $this->repository->delete($id);
	}

}
