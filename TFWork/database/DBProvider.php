<?php

include_once 'db.conf.php';

/**
 * Singleton database provider. Provides instances of FluentPDO for query building.
 * @author tweety
 *
 */
class DBProvider {

	/**
	 * Single PDO copy
	 * @var PDO
	 */
	private static $pdo;
	
	/**
	 * Provides FluentPDO instances based on a singular PDO database connection
	 * @return FluentPDO Instance of FluentPDO
	 * @see FluentPDO
	 */
	public static function provide() {
		if(self::$pdo === null) {
			try {
				self::$pdo = new PDO(
						DBTYPE . ':dbname=' . DBNAME, 
						DBUSER, 
						DBPASS, 
						array(
								PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
								PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
							)
						);
			} catch(PDOException $e) {
				DBReportError($e);
			}
		}
		
		return new FluentPDO(self::$pdo); 
	}
	
}