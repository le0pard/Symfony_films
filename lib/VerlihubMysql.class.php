<?php
// Verlihub integration 
//INSERT INTO reglist (reg_date,reg_op,nick,class,login_pwd,pwd_change,pwd_crypt) VALUES (unix_timestamp(now()),'admin_leo','leopard',1,encrypt('password'),0,1)

class VerlihubMysql {
	private $connection = null;
	public $error = false;
	
	public function __construct($mysql_host, $mysql_user, $mysql_password, $mysql_database) {
		$this->error = false;

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
	
	public function is_connect(){
		return !$this->error;
	}
	
	public function register_user($login, $password){
		if (!$this->is_connect()) return false;
		
		if ($login && $password){
			$query = sprintf(
				"INSERT INTO reglist (reg_date,reg_op,nick,class,login_pwd,pwd_change,pwd_crypt) VALUES (unix_timestamp(now()),'admin_leo','%s',1,encrypt('%s'),0,1)",
    			mysql_real_escape_string($login),
    			mysql_real_escape_string($password));
    		$result = mysql_query($query, $this->connection);
    		if ($result){
    			return true;
    		} else {
    			return false;
    		}
		}	
	}
	
	public function change_password_for_user($login, $new_password){
		if (!$this->is_connect()) return false;
		
		if ($login && $new_password){
			$query = sprintf("SELECT * FROM reglist WHERE nick='%s'",
			    mysql_real_escape_string($login));
			$result = mysql_query($query, $this->connection);
			if ($result){
				$num_rows = mysql_num_rows($result);
				if (1 == $num_rows){
					$row = mysql_fetch_array($result, MYSQL_ASSOC);
					$query = sprintf(
						"UPDATE reglist SET login_pwd = encrypt('%s') where nick = '%s' AND reg_date = '%s'",
						mysql_real_escape_string($new_password),
		    			mysql_real_escape_string($row['nick']),
		    			mysql_real_escape_string($row['reg_date']));
		    		$result = mysql_query($query, $this->connection);
		    		if ($result) return true;
				}
			}
		}
		return false;	
	}
	
	public function delete_user($login){
		if (!$this->is_connect()) return false;
		
		if ($login){
			$query = sprintf("SELECT * FROM reglist WHERE nick='%s'",
			    mysql_real_escape_string($login));
			$result = mysql_query($query, $this->connection);
			if ($result){
				$num_rows = mysql_num_rows($result);
				if (1 == $num_rows){
					$row = mysql_fetch_array($result, MYSQL_ASSOC);
					$query = sprintf(
						"DELETE from reglist WHERE nick = '%s' AND reg_date = '%s'",
		    			mysql_real_escape_string($row['nick']),
		    			mysql_real_escape_string($row['reg_date']));
		    		$result = mysql_query($query, $this->connection);
		    		if ($result) return true;
				}
			}
		}
		return false;
	}
	
	public function __destruct() {
		if ($this->connection){
			mysql_close($this->connection);
		}
	}
}
