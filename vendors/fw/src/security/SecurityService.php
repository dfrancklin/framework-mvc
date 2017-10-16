<?php

namespace FW\Security;

use \FW\Core\Config;

/**
 * @Service
 */
class SecurityService implements ISecurityService {

	private $appId;

	public function __construct() {
		$this->appId = Config::getInstance()->get('app-id');
	}

	public function isAuthenticated() : bool {
		if (session_status() !== PHP_SESSION_ACTIVE || session_id() === '') {
			return false;
		}

		if (is_null($this->getUserProfile())) {
			return false;
		}

		return true;
	}

	public function getUserProfile() {
		if (!array_key_exists($this->appId, $_SESSION) || !array_key_exists('user-profile', $_SESSION[$this->appId])) {
			return null;
		}

		$userProfile = unserialize($_SESSION[$this->appId]['user-profile']);

		return $userProfile;
	}

	public function hasRoles(array $roles) {
		if (!$this->isAuthenticated() || empty($roles)) {
			return false;
		}

		$userProfile = $this->getUserProfile();

		foreach ($roles as $role) {
			if (!in_array($role, $userProfile->getRoles())) {
				return false;
			}
		}

		return true;
	}

	public function hasAnyRoles(array $roles) {
		if (!$this->isAuthenticated() || empty($roles)) {
			return false;
		}

		$userProfile = $this->getUserProfile();

		foreach ($roles as $role) {
			if (in_array($role, $userProfile->getRoles())) {
				return true;
			}
		}

		return false;
	}

	public function authenticate(UserProfile $userProfile, bool $remember) : bool {
		if (session_status() !== PHP_SESSION_ACTIVE || session_id() === '') {
			return false;
		}

		$_SESSION[$this->appId]['user-profile'] = serialize($userProfile);

		if ($remember) {

		}

		return true;
	}

	public function logout() {
		if ($this->isAuthenticated()) {
			unset($_SESSION[$this->appId]['user-profile']);
		}

		if (!count($_SESSION[$this->appId])) {
			unset($_SESSION[$this->appId]);
		}

		if (!count($_SESSION)) {
			session_destroy();
		}
	}

}
