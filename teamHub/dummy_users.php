<?php 

$john = new USER([
	'id' => 2,
	'first_name' => 'John',
	'last_name' => 'Smith',
	'email' => 'john@email.com',
]);

$bruce = new USER([
	'id' 		=> 1,
	'first_name' => 'Bruce',
	'last_name' => 'Elgort',
	'email'	 	=> 'bruce@email.com',
]);

$chris = new USER([
	'id' 		=> 4,
	'first_name' => 'Chris',
	'last_name' => 'Mcguire',
	'email'	 	=> 'chris@email.com',
]);

$matt = new USER([
	'id' 		=> 3,
	'first_name' => 'Matt',
	'last_name' => 'Lehr',
	'email'	 	=> 'matt@email.com',
]);

class USER {
	var $id = null;
	var $first_name = null;
	var $last_name = null;
	var $email = null;

	function __construct($props) {
		$this->id = $props['id'];
		$this->first_name = $props['first_name'];
		$this->last_name = $props['last_name'];
		$this->email = $props['email'];
	}
}