<?php
require_once("includes/pdo.class.php");

class DB
{
	protected static $_instance = null;

	public static function GetConn() {
		if (self::$_instance == null) {
			self::$_instance = new Database();
		}

		return self::$_instance->GetConn();
	}
}

Class Database
{
	private $_connection = null;

	//we only want to create a connection when there isn't already a connection
	public function GetConn()
	{
		if($this->_connection != null) {
			return $this->_connection;
		}
		else {

			//@todo move to config, here for now :-)
			$HOST = 'localhost';
			$USER = "kr00ny_sfUser";
			$PASSWORD = "}8FCULdmEgqo";
			$DB = "kr00ny_sf";

			$this->_connection = $this->connect($HOST,$USER,$PASSWORD,$DB);
		}

		return $this->_connection;
	}

	private function connect($host,$user,$password,$db,$port = 3306,$charset = null)
	{
		$type = "mysql";
		$charset_param = "";
		if ($charset != null) {
			$charset_param = ";charset=$charset"; 
		}
		
		return new KroonyPDO("$type:host=$host;dbname=$db;port=$port$charset_param", $user, $password);
	}
}
