<?php
class Db {
	private $url = "localhost";
	private $dbname = "ateliermoucharabier";
	private $user = "root";
	private $password = "";
	private static $instance = null;
	private $_Db;

	private function __construct() {
		try {
			$this->_db = new PDO ( 'mysql:host='.$this->url.';dbname='.$this->dbname.';charset=utf8', $this->user, $this->password );
			$this->_db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$this->_db->setAttribute ( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ );
		} catch ( PDOException $e ) {
			die ( 'Erreur de connexion à la base de données : ' . $e->getMessage () );
		}
	}
	// Pattern Singleton
	public static function getInstance() {
		if (is_null ( self::$instance )) {
			self::$instance = new Db ();
		}
		return self::$instance;
	}
	

}