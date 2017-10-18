<?php

namespace App\Interfaces;

interface IProductService {

	function all();

	function page($offset, $quantity);

	function byId($id);

	function save($product);

	function delete($id);

}
