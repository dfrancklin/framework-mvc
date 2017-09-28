<?php

namespace FW\Security;

interface ISecurityService {

	public function isAuthenticated();

	public function getProfile();

	public function hasRoles($roles);

	public function authenticate($userProfile);

	public function logout();

}
