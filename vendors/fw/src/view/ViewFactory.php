<?php

namespace FW\View;

use \FW\Core\DependenciesManager;
use \FW\Security\ISecurityService;

/**
 * @Factory
 */
class ViewFactory implements IViewFactory {

	public static function create() : View {
		$security = DependenciesManager::getInstance()->resolve(ISecurityService::class);

		return new View($security);
	}

}
