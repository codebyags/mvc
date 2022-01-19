<?php
namespace Models;

use Model;
use MongoDB;

class CompanyModel extends Model
{
	protected $collectionName = 'companies';

	// Разрешённые поля
	protected $allowed = [
		"_id",
		"name",
		"logo",
		"about",
		"site",
		"manager_phone",
		"email",
		"u_phone",
		"u_contact"
	];

}