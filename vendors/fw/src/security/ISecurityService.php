<?php

namespace FW\Security;

interface ISecurityService {

	public function isAuthenticated() : bool;

	public function getUserProfile();

	public function hasRoles(array $roles);

	public function authenticate(UserProfile $userProfile) : bool;

	public function logout();

}
