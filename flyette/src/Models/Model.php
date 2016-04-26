<?php
namespace Flyette\Models;
use ORM;
class Model {

	protected $db;
	protected $table = 'basketBDD';


	public function __construct(){
		connect();
		$this->db = ORM::for_table($this->table);
	}

}