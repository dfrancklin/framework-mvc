<?php

namespace App\Services;

use App\Interfaces\ILoginService;

/**
 * @Service
 */
class LoginService implements ILoginService {

	private $usersTable;

	public function __construct() {
		$this->usersTable = [];

		$this->usersTable[] = (object) [
			'id' => 1,
			'name' => 'Diego Francklin',
			'email' => 'dfrancklin23@gmail.com',
			'pass' => '123',
			'roles' => ['ADMIN', 'USER'],
		];

		$this->usersTable[] = (object) [
			'id' => 2,
			'name' => 'admin',
			'email' => 'admin@email.com',
			'pass' => '1234',
			'roles' => ['ADMIN', 'USER'],
		];

		foreach(range(3, 10) as $id) {
			$this->usersTable[] = (object) [
				'id' => $id,
				'name' => 'System User #' . $id,
				'email' => 'system.user.' . $id . '@email.com',
				'pass' => 'xpto@' . $id,
				'roles' => ['USER'],
			];
		}
	}

	public function authenticate($email, $pass) {
		foreach ($this->usersTable as $user) {
			if ($user->email === $email && $user->pass === $pass) {
				return $user;
			}
		}
	}

}
