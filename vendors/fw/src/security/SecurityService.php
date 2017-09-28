<?php

namespace FW\Security;

/**
 * @Service
 */
class SecurityService implements ISecurityService {

	public function __construct() {

	}

	public function isAuthenticated() {
		return false;
	}

	public function getProfile() {
		return new UserProfile();
	}

	public function hasRoles($roles) {
		return true;
	}

	public function authenticate($userProfile) {

	}

	public function logout() {

	}

}
