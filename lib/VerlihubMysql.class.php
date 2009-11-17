<?php
//  
//INSERT INTO reglist (reg_date,reg_op,nick,class,login_pwd,pwd_change,pwd_crypt) VALUES (unix_timestamp(now()),'admin_leo','leopard',1,encrypt('password'),0,1)

class VerlihubMysql {
	private $connection = null;
	public $error = false;
	
	public function __construct($mysql_host, $mysql_user, $mysql_password, $mysql_database) {
		$this->connection = @mysql_connect($mysql_host, $mysql_user, $mysql_password);
		if (!$this->connection){
			$this->error = true;
		} else {
			$res_db = @mysql_select_db($mysql_database, $this->connection);
			if (!$res_db){
				$this->error = true;
			}
		}
	}
	
	public function __destruct() {
		if ($this->connection){
			mysql_close($this->connection);
		}
	}
}
