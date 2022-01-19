<?php
namespace Models\Auth;

use App\Model;

class AuthModel extends Model
{
	public function genArSaltAndHashPassword($password) {
		$salt = md5(rand(0,999) . time() . rand(0,999));
		$hash = hash("sha256", $salt . $password);
		return [ 'salt' => $salt, 'hash' => $hash];
	}

	public function checkHashPassword($password, $salt, $hash) {
		return hash("sha256", $salt . $password) === $hash;
	}


}